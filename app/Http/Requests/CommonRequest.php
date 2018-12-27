<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CommonRequest extends Request
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
        $fields = $this->input('name');
        switch ($fields) {
            case 'wording':
            case 'firstname':
            case 'lastname':
            case 'name':
            case 'intro':
                $data = array('value' => 'required|string');
                break;
            case 'comment':
            case 'emails':
                $data = array('value' => 'string');
                break;
            case 'email':
                $data = array('value' => 'required|email');
                break;
            case 'begin':
            case 'end':
                $data = array('value' => 'required|date_format:d/m/Y');
                break;
            case 'type':
                $data = array('value' => 'required|in:open,close');
                break;
            case 'enabled':
                $data = array('value' => 'required|boolean');
                break;
        }
        return $data;
    }
}
