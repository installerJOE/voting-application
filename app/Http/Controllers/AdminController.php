<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\Contest;
use App\Models\Contestant;
use App\Models\Vote;
use App\Models\Image;
use App\Models\User;
use App\Models\Admin;
use App\Mail\ContestVotingStartedMail;
use App\Mail\ContestVotingEndsMail;
use App\Services\Assets\ImageService;
use App\Services\Admin\ContestService;
use App\Services\GeneralService;
use App\Http\Requests\StoreContestRequest;
use App\Http\Requests\UpdateContestRequest;



class AdminController extends Controller
{
    protected $generalService;
    protected $contestService;

    public function __construct(GeneralService $generalService, ContestService $contestService){
        $this->generalService = $generalService;
        $this->contestService = $contestService;
    }

    public function dashboard(){
        return view('user.admin.dashboard');
    }

    public function contests(){
        return view('user.admin.contests')->with([
            "contests" => Contest::orderBy('created_at', 'DESC')->paginate(5)
        ]);
    }

    public function showContest($slug){
        $contest = Contest::where('slug', $slug)->firstOrFail();
        return view('user.admin.showContest')->with([
            "contest" => $contest,
            "cover_image" => $contest->images()->where('cover_image', true)->first()
        ]);
    }

    public function showContestRequests($slug){
        $contest = Contest::where('slug', $slug)->firstOrFail();
        return view('user.admin.contest-requests')->with([
            "contest" => $contest
        ]);
    }

    public function createNewContest(){
        return view('user.admin.create-contest');
    }

    public function storeContest(StoreContestRequest $request, ImageService $imageService){
        $validated = $request->validated();       
        $contestSaved = $this->contestService->addNewContest($validated);        
        
        if($contestSaved["complete"] == false){
            return $this->generalService->redirectBackOnError($request, $contestSaved["error"]);
        }

        $imageUploaded = $imageService->uploadAndSaveImage([
            "cover_image" => true,
            "imageable" => $contestSaved["data"],
            "update_image" => false,
            "filenameAttribute" => "slug",
            "image" => $validated["cover_image"]
        ], null);        
        
        if(!$imageUploaded) return $this->contestService->redirectOnImageError($contestSaved["data"]);
        
        return redirect()->route('admin.contests.overview')->with([
            "success" => "Contest has been created successfully"
        ]);
    }

    public function updateContestImage(Request $request, Contest $contest, ImageService $imageService){
        $this->validate($request, [
            "cover_image" => "required",
        ]);

        $imageUploaded = $imageService->uploadAndSaveImage([
            "cover_image" => true,
            "imageable" => $contest,
            "update_image" => true,
            "filenameAttribute" => "slug",
            "image" => $request->input('cover_image')
        ], $contest->images()->where('id', $request->image_id)->first());        

        if(!$imageUploaded) return $this->generalService->redirectBackOnError($request, "An error occured during upload");
        return $this->contestService->redirectToContestPage($contest, "Cover image has been updated successfully");
    }
    
    public function deleteContest(Request $request, Contest $contest){
        if($contest->status == "active"){
            return $this->generalService->redirectBackOnError($request, "This contest is active and so cannot be deleted");
        }
        $contest->delete();
        return redirect()->route('admin.contests.overview')->with([
            "success" => "Contest has been deleted successfully."
        ]);
    }

    public function startContestReg(Contest $contest){
        $contestVotingStarted = $this->contestService->startRegistration($contest);
        $message = "Contest registration has been started successfully";
        return $this->contestService->redirectToContestPage($contest, $message);
    }

    public function endContestReg(Contest $contest){
        $contest->update([
            "registration_end_at" => Carbon::now(),
            "updated_by" => auth()->user()->id,
        ]);

        $message = "Contest registration has been ended successfully";
        return $this->contestService->redirectToContestPage($contest, $message);
    }

    public function startContestVoting(Request $request, Contest $contest){
        $contestVotingStarted = $this->contestService->startVoting($contest);
        if(!$contestVotingStarted){
            return $this->generalService->redirectBackOnError($request, "You have not started registration yet");
        }        
        return $this->contestService->redirectToContestPage($contest, "Voting has been started for this contest successfully");
    }

    public function endContestVoting(Request $request, Contest $contest){
        $votingEnded = $this->contestService->endVoting($contest);
        if(!$votingEnded){
            return $this->generalService->redirectBackOnError($request, "You have not started voting session yet");
        }        
        return $this->contestService->redirectToContestPage($contest, "You have successfully ended voting for this contest.");
    }


    public function updateContestBaseData(UpdateContestRequest $request, Contest $contest){
        $validated = $request->validated();
        $contest->updateBaseData($request);
        return $this->contestService->redirectToContestPage($contest, "Base data of this contest has been updated successfully");
    }

    public function updateContestRegData(){
        $this->validate($request, [
            "registration_duration" => "required|integer",
            "reg_start_date" => "required",
        ]);
        
        $reg_starting_date = Carbon::parse(date($request->input('reg_start_date')));
        if(time() > strtotime($reg_starting_date)) {
            return back()->withInput($request->input())->with([
                "error" => "Registration start date must not be a past date."
            ]);
        }

        $contest->update([
            "registration_start_at" => $reg_starting_date->format('Y-m-d H:i:s'),
            "registration_end_at" => $reg_starting_date->addDays($request->input('voting_duration')),
        ]);
        
        return $this->redirectRoute($contest, "Registration information of this contest has been updated successfully");
    }

    public function updateContestVotingData(Request $request, Contest $contest){
        $this->validate($request, [
            "amount_per_vote" => "required|numeric",
            "voting_duration" => "required|integer",
            "voting_start_date" => "required",
        ]);
        
        $voting_starting_date = Carbon::parse(date($request->input('voting_start_date')));
        if(strtotime($contest->registration_end_at) > strtotime($voting_starting_date)) {
            return back()->withInput($request->input())->with([
                "error" => "Voting start date must be after registration end date"
            ]);
        }

        $contest->update([
            "amount_per_vote" => $request->input('amount_per_vote'),     
            "vote_start_at" => $voting_starting_date->format('Y-m-d H:i:s'),
            "vote_end_at" => $voting_starting_date->addDays($request->input('voting_duration')),
        ]);
        
        return $this->redirectRoute($contest, "Voting information of this contest has been updated successfully");
    }

    public function acceptContestant(Request $request, $slug){
        $contest = Contest::where('slug', $slug)->firstOrFail();
        $this->validate($request, [
            "contestant_id" => "required"
        ]);

        $contestant = $contest->contestants()->where('id', $request->input('contestant_id'))->first()->update([
            "status" => "accepted"
        ]);

        return back()->with('success', 'Contestant has been accepted successfully.');
    }

    public function addUserToAdmin(User $user){
        $user->admin()->create([
            "super_admin" => false
        ]);
        return redirect()->route('admin.dashboard')->with("success", "$user->name has been given admin privileges successfully");
    }
}
