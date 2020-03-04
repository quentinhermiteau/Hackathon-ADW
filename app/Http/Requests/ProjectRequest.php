<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "name"                  => "required|string",
            "description"           => "required|string",
            "realisation_date"      => "required|date",
            "status"                => "required|in:WAITING,IN_PROGRESS,DONE",
            "client_name"           => "required|string",
            "contact_lastname"      => "required|string",
            "contact_phone_number"  => "required|string",
            "budget_min"            => "required|numeric|min:0",
            "budget_max"            => "required|numeric|gt:budget_min",
            "referent_id"           => "required|exists:users,id"
        ];
    }
}
