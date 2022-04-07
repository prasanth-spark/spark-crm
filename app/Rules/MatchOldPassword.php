<?php

namespace App\Rules;

use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\User;



class MatchOldPassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $oldPassword=user::where('id',Session::get('id'))->value('password');
        return Hash::check($value, $oldPassword);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is match with old password.';
    }
}
