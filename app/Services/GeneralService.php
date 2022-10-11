<?php

namespace App\Services;

class GeneralService
{
    public function redirectBackOnError($request, $message){
        return back()->withInput($request->input())->with([
            "error" => $message,
        ]);
    }
}