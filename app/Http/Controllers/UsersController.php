<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function profile(){
        return view('user.settings.profile');
    }

    public function security(){
        return view('user.settings.security');
    }
}
