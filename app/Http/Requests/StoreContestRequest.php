<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class StoreContestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => "required|max:255|min:4|unique:contests",
            "description" => "required|min:10",
            "prize" => "required",
            "number_of_contestants" => "required|integer",
            "registration_start_date" => "required",
            "registration_duration" => "required",
            "voting_start_date" => "required",
            "voting_duration" => "required",
            "amount_per_vote" => "required",
            "cover_image" => "required"
        ];
    }
}
