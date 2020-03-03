<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'mark' => 'required|float|min:0|max:5',
            'comment' => 'required|string',
            'status' => 'required|string|in_array:ENABLED,DISABLED',
            'reviewer_id' => 'required|integer|exists:users,id',
            'agent_id' => 'required|integer|exists:users,id'
        ];
    }
}
