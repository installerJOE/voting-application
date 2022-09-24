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
        ]);
        

        $reg_start_date = $request->input('registration_start_date');
        $reg_duration = $request->input('registration_duration');
        $reg_end_date = $this->calculateEndDate($reg_start_date, $reg_duration);
        
        $voting_start_date = $request->input('voting_start_date');
        $voting_duration = $request->input('voting_duration');

        if(strtotime(now()) > strtotime($reg_start_date)){
            return back()->withInput($request->input())->with([
                "error" => "Registration date must be ahead of today",
            ]);
        }

        if(strtotime($voting_start_date) < strtotime($reg_end_date)){
            return back()->withInput($request->input())->with([
                "error" => "Please adjust the Voting Start Date to a date that comes after contest registration period",
            ]);
        }
        
        $contest = Contest::create([
            "name" => $request->input('name'),
            "slug" => Str::slug($request->input('name')),
            "description" => $request->input('description'),
            "contestants_needed" => $request->input('number_of_contestants'),
            "prize" => $request->input('prize'),        
            "registration_start_at" => $reg_start_date,
            "registration_end_at" => $reg_end_date,
            "vote_start_at" => $voting_start_date,
            "vote_end_at" => $this->calculateEndDate($voting_start_date, $voting_duration),
        ]);

        return redirect()->route('admin.contests')->with([
            "success" => "Contest has been created successfully"
        ]);
    }

    private function calculateEndDate($start_date, $duration_in_days){
        $timestamp = strtotime($start_date) + ($duration_in_days * 24 * 60 * 60);
        $end_date = date('Y-m-d H:i:s', $timestamp-1);
        return $end_date;
    }

    public function startContestReg(Contest $contest){
        $contest->update([
            "registration_start_at" => Carbon::now(),
            "registration_end_at" => $this->calculateEndDate(Carbon::now(), $contest->registration_duration()),
        ]);

        $message = "Contest registration has been started successfully";
        return $this->redirectRoute($contest, $message);
    }

    public function endContestReg(Contest $contest){
        $contest->update([
            "registration_end_at" => Carbon::now(),
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
            $contest->registration_end_at = Carbon::now();
        }
        $contest->vote_start_at = Carbon::now();
        $contest->registration_end_at = $this->calculateEndDate(Carbon::now(), $contest->voting_duration());
        $contest->save();

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
            "vote_end_at" => Carbon::now()
        ]);

        $message = "Voting has been started  for this contest  successfully";
        return $this->redirectRoute($contest, $message);
    }

    private function redirectRoute($contest, $message){
        return redirect()->route('admin.showContest', ['slug' => $contest->slug])->with([
            "success" => $message
        ]);
    }
}
