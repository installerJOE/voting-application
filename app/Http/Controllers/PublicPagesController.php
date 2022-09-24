<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contest;
use App\Models\User;
use App\Models\Contestant;
use App\Models\Vote;
use App\Models\Image;
use App\Models\Admin;

class PublicPagesController extends Controller
{
    public function index(){
        return view('public.index');
    }

    public function about(){
        return view('public.about');
    }

    public function contact(){
        return view('public.contact');
    }

    public function contests(){
        return view('public.contests')->with([
            "contests" => Contest::all()
        ]);
    }

    public function showContest($slug){
        return view('public.showContest')->with([
            "contest" => Contest::where('slug', $slug)->firstOrFail()
        ]);
    }

    public function showContestant($slug, $contestant_number){
        $contest = Contest::where('slug', $slug)->firstOrFail();
        $contestant = Contestant::where('contestant_number', $contestant_number)->firstOrFail();
        
        if($contest != $contestant->contest){
            return back()->with('error', 'Sorry, this contestant has been disqualified from this contest');
        }
        
        return view('public.showContestant')->with([
            "contestant" => $contestant
        ]);
    }

    public function voteContestant(Request $request){
        $this->validate($request, [
            "phone_number" => "required",
            "username" => "required",
            "contestant_id" => "required",
        ]);

        return $request;
    }

    public function subscribeNewsletter(Request $request){
        $this->validate($request, [
            "email" => "max:255|required|email"
        ]);

        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        if($user === null){
            $user = User::create([
                'email' => $email,
            ]);
        }
        
        if($user->is_subscribed) return back()->with([
            "info" => "Oops! You are already subscribed."
        ]);
        
        $user->update([
            "is_subscribed" => true
        ]);

        // redirect to previous page with success message
        return back()->with('success', 'Thanks for subscribing to our newsletters.');
    }
}
