<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProfileUpdateRequest extends Request
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
            'name' => 'required|string',
            'role' => 'string',
            'email_address' => 'email|required',
            'work_phone' => 'string',
            'home_phone' => 'string',
            'mobile_phone' => 'string',
            'fax' => 'string',
        ];
    }
}
