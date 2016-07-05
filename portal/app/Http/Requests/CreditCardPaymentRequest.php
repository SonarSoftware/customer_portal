<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreditCardPaymentRequest extends Request
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
            'cc-number' => 'required_if:payment_method,new_card|string', //this can contain spaces
            'name' => 'required_if:payment_method,new_card|string',
            'expirationDate' => 'required_if:payment_method,new_card|string', //this has the / separator in it
            'makeAuto' => 'boolean',
            'amount' => 'required|numeric|min:0.01',
        ];
    }
}
