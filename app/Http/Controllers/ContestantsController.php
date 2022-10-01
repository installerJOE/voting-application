<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contest;
use App\Models\Contestant;
use App\Http\Requests\ContestantRegistration;

class ContestantsController extends Controller
{
    public function dashboard(){
        return view('user.contestant.dashboard');
    }

    public function contests(){
        return view('user.contestant.contests')->with([
            "contestants" => auth()->user()->contestants
        ]);
    }
    
    public function register(Request $request){
        return view('user.contestant.register')->with([
            "contests" => Contest::where('registration_end_at' , '>', now())->where('registration_start_at', '<', now())->get()
        ]);
    }
    
    public function showContest($slug){
        $contest = Contest::where('slug', $slug)->firstOrFail();
        return view('user.contestant.dashboard');
    }

    public function registerContest(ContestantRegistration $request){
        $slug = $request->input('contest') ?? $request->input('contest_slug');
        $contest = Contest::where('slug', $slug)->firstOrFail();
        
        $user = auth()->user();
        $validated = $request->validated();
        $username = $validated['username'];

        $sameUsername = Contestant::where('user_id', '!=', $user->id)->where('name', $username)->first();
        if($sameUsername !== null) return back()->withInput($request->input())->with([
            "error" => "This username has been taken by another contestant"
        ]);

        $contestant = $contest->contestants()->create([
            "name" => $username,
            "contestant_number" => Contestant::generate_contestant_no(),
            "profile_overview" => $validated['profile_overview'],
            "user_id" => $user->id,
            "status" => "requested",
        ]);
        
        $imageUploaded = $contestant->save_image_to_storage($request->input('cover_image'));
        if(!$imageUploaded) return $this->redirectOnImageError();

        if($request->input('secondary_image') !== null) {
            $imageUploaded = $contestant->save_image_to_storage($request->input('secondary_image'));
            if(!$imageUploaded) return $this->redirectOnImageError();
        }

        return redirect()->route('contestant.dashboard')->with([
            "success" => "Your application has been submitted successfully."
        ]);
    }

    private function redirectOnImageError(){
        $contestant->update([
            "status" => "draft"
        ]);
        return redirect()->route('user.contests')->with([
            "error" => "Your application was saved, but an error occured during image upload."
        ]);
    }
}
