<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => "required|alpha|max:15",
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|',
            'role'=>'required',
        ];
    }
}