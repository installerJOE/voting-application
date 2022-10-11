<?php

namespace App\Services\Admin;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Contest;


class ContestService
{
    public function addNewContest($validated){
        $reg_start_date = Carbon::parse(date($validated['registration_start_date']));
        $voting_start_date = Carbon::parse(date($validated['voting_start_date']));
        $reg_end_date = Carbon::parse(date($validated['registration_start_date']))->addDays($validated['registration_duration']);
            
        if(time() > strtotime($reg_start_date)) return [
            "complete" => false,
            "error" => "Registration date must be ahead of today",
        ];
            
        if(strtotime($voting_start_date) < strtotime($reg_end_date)) return [
            "complete" => false,
            "error" => "Please adjust the 'voting start date' to a date that comes after contest registration period",
        ];

        $contest = Contest::create([
            "name" => $validated['name'],
            "slug" => Str::slug($validated['name']),
            "description" => $validated['description'],
            "contestants_needed" => $validated['number_of_contestants'],
            "prize" => $validated['prize'],        
            "amount_per_vote" => $validated['amount_per_vote'],        
            "registration_start_at" => $reg_start_date->format('Y-m-d H:i:s'),
            "registration_end_at" => $reg_end_date,
            "vote_start_at" => $voting_start_date->format('Y-m-d H:i:s'),
            "vote_end_at" => $voting_start_date->addDays($validated['voting_duration']),
            "updated_by" => auth()->user()->id
        ]);

        return [
            "complete" => true,
            "data" => $contest,
        ];
    }

    public function redirectOnImageError($contest){
        $contest->update([
            "status" => "draft"
        ]);
        return redirect()->route('admin.contests.overview')->with([
            "error" => "Contest has been saved successfully, but an error occured during image upload."
        ]);
    }

    public function redirectToContestPage($contest, $message){
        return redirect()->route('admin.showContest', ['slug' => $contest->slug])->with([
            "success" => $message
        ]);
    }

    public function startRegistration($contest){
        return $contest->update([
            "registration_start_at" => Carbon::now(),
            "registration_end_at" => Carbon::now()->addDays($contest->registration_duration()),
            "updated_by" => auth()->user()->id,
        ]);
    }

    public function startVoting($contest){
        if($contest->registration_status() == null) return false;

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
        // $this->sendMailToContestants($contestant, new ContestVotingStartedMail($contestant));

        return true;
    }

    public function endVoting($contest){
        if($contest->voting_status() != "active") return false;
        $contest->update([
            "vote_end_at" => Carbon::now(),
            "updated_by" => auth()->user()->id
        ]);

        // send notification to contestants
        // $this->sendMailToContestants($contestant, new ContestVotingEndsMail($contestant));

        return true;
    }

    private function sendMailToContestants($contestant, $mailClass){
        foreach($contest->contestants as $contestant){
            Mail::to($contestant->user->email)->send($mailObject);
        }
    }
}