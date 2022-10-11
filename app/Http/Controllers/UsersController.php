<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function profile(){
        return view('user.settings.profile')->with([
            "profile_image" => auth()->user()->profile_image ?? "noimage.jpg"
        ]);
    }

    public function security(){
        return view('user.settings.security');
    }

    public function updateProfileImage(Request $request){
        $this->validate($request, [
            "profile_image" => "required"
        ]);
        
        $profile_image_updated = auth()->user()->update_profile_pic($request);
        if($profile_image_updated) return redirect()->route('user.profile')->with([
            'success' => 'Profile picture has been updated successfully'
        ]);

        return $this->redirectBackIfError($request, "An error occured while uploading the image. Please try again later.");
    }

    public function updateBioData(Request $request){
        $this->validate($request, [
            "name" => "required|max:255",
            "username" => "required|max:255",
            "phone_number" => "required|max:255|string"
        ]);

        $user = User::where('username', $request->input('username'))->where('id', '!=', auth()->user()->id)->first();
        if($user !== null) return $this->redirectBackIfError($request, "This username already exists.");

        auth()->user()->update_bio_data($request);        
        return redirect()->route('user.profile')->with([
            "success" => "Your Bio Data has been updated successfully"
        ]);
    }   

    private function redirectBackIfError($request, $error){
        return back()->withInput($request->input())->with([
            "error" => $error
        ]);
    }

    public function updatePassword(Request $request){
        $this->validate($request, [
            "password" => "confirmed|min:8|string|required"
        ]);
        auth()->user()->update_password($request);
        return redirect()->route("user.security")->with([
            "success" => "Password has been updated successfully."
        ]);
    }
}
