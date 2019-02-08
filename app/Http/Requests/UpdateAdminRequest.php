<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateAdminRequest extends Request
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
        return array(
            'email' => "required|email",
            'firstname' => "required|string",
            'lastname' => "required|string",
            'password_confirmation' => 'required_with:password|same:password'
        );
    }
}
