<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private function redirectOnImageError(){
        $contestant->update([
            "status" => "draft"
        ]);
        return redirect()->route('admin.contests.overview')->with([
            "error" => "Contest has been saved successfully, but an error occured during image upload."
        ]);
    }
}
