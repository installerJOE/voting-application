<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContestantsController extends Controller
{
    public function dashboard(){
        return view('user.contestant.dashboard');
    }

    public function registerForContest($slug){
        return view('user.contestant.dashboard');
    }

    public function submitContestRegistration($slug){
        return view('user.contestant.dashboard');
    }
}
