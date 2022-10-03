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

class AdminController extends Controller
{
    public function dashboard(){
        return view('user.admin.dashboard');
    }

    public function contests(){
        return view('user.admin.contests')->with([
            "contests" => Contest::all()
        ]);
    }

    public function showContest($slug){
        $contest = Contest::where('slug', $slug)->firstOrFail();
        return view('user.admin.showContest')->with([
            "contest" => $contest
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

    public function storeContest(Request $request){
        $this->validate($request, [
            "name" => "required|max:255|min:4|unique:contests",
            "description" => "required|min:10",
            "prize" => "required",
            "number_of_contestants" => "required|integer",
            "registration_start_date" => "required",
            "registration_duration" => "required",
            "voting_start_date" => "required",
            "voting_duration" => "required",
            "amount_per_vote" => "required",
        ]);
        
        $reg_start_date = Carbon::parse(date($request->input('registration_start_date')));
        $voting_start_date = Carbon::parse(date($request->input('voting_start_date')));
        $reg_end_date = Carbon::parse(date($request->input('registration_start_date')))->addDays($request->input('registration_duration'));
        
        if(time() > strtotime($reg_start_date)){
            return back()->withInput($request->input())->with([
                "error" => "Registration date must be ahead of today",
            ]);
        }

        if(strtotime($voting_start_date) < strtotime($reg_end_date)){
            return back()->withInput($request->input())->with([
                "error" => "Please adjust the 'voting start date' to a date that comes after contest registration period",
            ]);
        }
        
        $contest = Contest::create([
            "name" => $request->input('name'),
            "slug" => Str::slug($request->input('name')),
            "description" => $request->input('description'),
            "contestants_needed" => $request->input('number_of_contestants'),
            "prize" => $request->input('prize'),        
            "amount_per_vote" => $request->input('amount_per_vote'),        
            "registration_start_at" => $reg_start_date->format('Y-m-d H:i:s'),
            "registration_end_at" => $reg_end_date,
            "vote_start_at" => $voting_start_date->format('Y-m-d H:i:s'),
            "vote_end_at" => $voting_start_date->addDays($request->input('voting_duration')),
            "updated_by" => auth()->user()->id
        ]);

        return redirect()->route('admin.contests.overview')->with([
            "success" => "Contest has been created successfully"
        ]);
    }

    public function startContestReg(Contest $contest){
        $contest->update([
            "registration_start_at" => Carbon::now(),
            "registration_end_at" => Carbon::now()->addDays($contest->registration_duration()),
            "updated_by" => auth()->user()->id,
        ]);

        $message = "Contest registration has been started successfully";
        return $this->redirectRoute($contest, $message);
    }

    public function endContestReg(Contest $contest){
        $contest->update([
            "registration_end_at" => Carbon::now(),
            "updated_by" => auth()->user()->id,
        ]);

        $message = "Contest registration has been ended successfully";
        return $this->redirectRoute($contest, $message);
    }

    public function startContestVoting(Contest $contest){
        if($contest->registration_status() == null){
            $message = "You have not started registration yet";
            return $this->redirectRoute($contest, $message);
        }
        
        if($contest->registration_status() == "active"){
            $contest->update([
                "registration_end_at" => Carbon::now()
            ]);
        }
        $contest->update([
            "vote_start_at" => Carbon::now(),
            "updated_by" => auth()->user()->id,
        ]);
        
        // send notification to contestants
        // foreach($contest->contestants as $contestant){
        //     Mail::to($contestant->user->email)->send(new ContestVotingStartedMail($contestant));
        // }

        
        $message = "Voting has been started for this contest successfully";
        return $this->redirectRoute($contest, $message);
    }

    public function endContestVoting(Contest $contest){
        
        // send notification to contestants
        // foreach($contest->contestants as $contestant){
        //     Mail::to($contestant->user->email)->send(new ContestVotingEndsMail($contestant));
        // }

        if($contest->voting_status() != "active"){
            $message = "You have not started voting session yet";
            return $this->redirectRoute($contest, $message);
        }

        $contest->update([
            "vote_end_at" => Carbon::now(),
            "updated_by" => auth()->user()->id
        ]);

        $message = "You have successfully ended voting for this contest.";
        return $this->redirectRoute($contest, $message);
    }

    private function redirectRoute($contest, $message){
        return redirect()->route('admin.showContest', ['slug' => $contest->slug])->with([
            "success" => $message
        ]);
    }

    public function updateContestBaseData(Request $request, Contest $contest){
        $this->validate($request, [
            "description" => "required|min:10",
            "prize" => "required",
            "number_of_contestants" => "required|integer",
        ]);

        if($request->input('name') !== $contest->name) $this->validate($request, [
            "name" => "required|max:255|min:4|unique:contests",
        ]);

        $contest->update([
            "name" => $request->input('name'),
            "slug" => Str::slug($request->input('name')),
            "description" => $request->input('description'),
            "contestants_needed" => $request->input('number_of_contestants'),
            "prize" => $request->input('prize'),        
        ]);        
        return $this->redirectRoute($contest, "Base data of contest has been updated successfully");
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
