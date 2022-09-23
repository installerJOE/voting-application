<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContestantsController extends Controller
{
    public function dashboard(){
        return view('user.contestant.dashboard');
    }
}
