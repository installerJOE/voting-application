<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Contest;
use App\Models\Contestant;
use App\Models\Vote;
use App\Models\Image;
use App\Models\User;
use App\Models\Admin;

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
        return view('user.admin.showContest');
        
        // return view('user.admin.showContest')->with([
        //     "contest" => Contest::where('slug', $slug)->firstOrFail()
        // ]);
    }

    public function createNewContest(){
        return view('user.admin.create-contest');
    }

    public function storeContest(Request $request){
        $this->validate($request, [
            "contest_name" => "required|max:255|min:4",
            "description" => "required|min:10",
            "prize" => "required",
            "number_of_contestants" => "required|integer",
            "registration_date" => "required",
            "registration_duration" => "required",
            "voting_date" => "required",
            "voting_duration" => "required",
            // "registration_form" => "required|string",
        ]);
        return $request;
    }
}
