<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateCreditCardRequest extends Request
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
            'cc-number' => 'required|string', //this can contain spaces
            'name' => 'required|string',
            'expirationDate' => 'required|string', //this has the / separator in it
            'country' => 'required|string',
            'line1' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
            'auto' => 'boolean',
        ];
    }
}
