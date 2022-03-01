<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
            'father_name'=>"required|alpha|max:15",
            'mother_name'=>"required|alpha|max:15",
            'phone_number' => 'required|numeric|min:10',
            'emergency_contact_number' => 'required|numeric|min:10',
            'official_email' => 'required|email',
            'joined_date' => 'required|date|date_format:Y-m-d',
            'home_address' => 'required','regex:/([- ,\/0-9a-zA-Z]+)/',
            'date_of_birth' => 'required|date|date_format:Y-m-d',
            'blood_group' =>'required','regex:(A|B|AB|O)[+-]/',
            'aadhar_number' => 'required|numeric|min:12',
            'team_name'=>'required',         
        ];
    }
}
