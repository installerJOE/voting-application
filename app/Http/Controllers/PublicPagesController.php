<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contest;
use App\Models\User;
use App\Models\Contestant;
use App\Models\Vote;
use App\Models\Image;
use App\Models\Admin;
use App\Models\Partner;
use AfricasTalking\SDK\AfricasTalking;

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
        $active_contests = [];
        foreach(Contest::all() as $contest){
            if($contest->registration_status() !== null){
                $active_contests[] = $contest;
            }
        }
        return view('public.contests')->with([
            "contests" => $active_contests
        ]);
    }

    public function showContest($slug){
        return view('public.showContest')->with([
            "contest" => Contest::where('slug', $slug)->firstOrFail()
        ]);
    }

    public function contestRegistration($slug){
        return view('public.registerContest')->with([
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

    public function voteContestant(Request $request, $slug, $contestant_number){
        $this->validate($request, [
            "phone_number" => "required",
            "username" => "required",
        ]);

        // send OTP for verification before completing the request
        
        $contestant = Contestant::where('contestant_number', $contestant_number)->firstOrFail();
        $contest = Contest::where('slug', $slug)->firstOrFail();

        if($contestant->contest != $contest) return back()->withInput($request->input())->with([
            "error" => "Sorry, an error ocurred somewhere. Please try again later"
        ]);

        $payments = $this->checkOutPayment($request, $contestant);

        if(!$payments['completed']) return back()->withInput($request->input())->with([
            "error" => "An error occured somewhere, please try again later."
        ]);

        $phone_number = $request->input('phone_number');
        $username = $request->input('username');
        $voter = $contestant->votes()->where('phone_number', $phone_number)->first();
        if($voter == null){
            $voter = $contestant->votes()->create([
                "phone_number" => $phone_number,
                "username" => $username,
            ]);
        }
        $voter->number_of_votes++;
        $voter->save();

        $contestant->number_of_votes++;
        $contestant->save();

        return redirect()->route('public.showContestant', [
            "slug" => $contestant->contest->slug,
            "contestant_number" => $contestant->contestant_number,
        ])->with([
            "success" => "Payment has been initiated."
        ]);        
    }

    public function subscribeNewsletter(Request $request){
        $this->validate($request, [
            "email" => "max:255|required|email"
        ]);

        $email = $request->input('email');
        $user = User::where('email', $email)->first() ?? User::create(['email' => $email]);
        
        if($user->subscribed) return $this->redirectBackIfError($request, "Oops! You are already subscribed.");
        
        $user->update(["subscribed" => true]);
        return back()->with('success', 'Thanks for subscribing to our newsletters.');
    }

    private function checkOutPayment($request, $contestant){
        $AT = new AfricasTalking(config('africanstalking.username'), config('africanstalking.apiKey'));
        $productName;
        try {
            $result = $AT->payments()->mobileCheckout([
                "productName" => $productName,
                "phoneNumber" => $request->input('phone_number'),
                "currencyCode" => $contestant->contest->currency_code ?? "KES",
                "amount" => $contestant->contest->amount_per_vote,
                "metadata" => [
                    "contestant" => $contestant->contestant_number
                ],
            ]);
            return [
                "completed" => true,
                "data" => $result,
                "message" => "success"
            ];
        } catch(Exception $e) {
            return [
                "completed" => false,
                "message" => $e->getMessage()
            ];
        }
    }

    public function sendSponsorshipRequest(Request $request, Contest $contest){
        $this->validate($request, [
            "company_name" => "required|string",
            "email" => "required|email",
            "sender_name" => "required|string",
            "job_role" => "required|string",
        ]);

        $partner = Partner::where('email', $request->input('email'))->first() ?? Partner::create([
            "company_name" => $request->input('company_name'),
            "email" => $request->input('email'),
            "sender_name" => $request->input('sender_name'),
            "job_role" => $request->input('job_role'),
        ]);
        
        $contestPartnershipExists = $contest->partners()->where("partner_id", $partner->id)->first() !== null ? true : false;
        if($contestPartnershipExists) return $this->redirectBackIfError($request, "You already sent a partnership request. Thanks.");
        $contest->partners()->attach($partner->id);

        return redirect()->route('public.contests')->with([
            'success' => 'Your partnership request has been sent successfully. Thanks.'
        ]);
    }

    private function redirectBackIfError($request, $error){
        return back()->withInput($request->input())->with([
            "error" => $error
        ]);
    }
}
