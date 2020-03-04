<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string',
            'birthday' => 'required|date',
            'description' => 'required|string',
            'role' => 'required|string|in:ADMIN,AGENT',
            'status' => 'required|string|in:ENABLED,DISABLED'
        ];
    }
}
