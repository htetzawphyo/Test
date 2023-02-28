<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'full_name' => 'required|string',
            'user_name' => 'required|string',
            'user_role' => 'required',
            'user_phone' => 'required',
            'email' => 'required|string',
            // 'user_password' => 'required|min:8|max:20',
            'user_gender' => 'required'
        ];
    }
}
