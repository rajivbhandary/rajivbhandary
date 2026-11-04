<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEnquiryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * Accept the ways people actually type Indian mobile numbers
     * (+91 98200 12345, 098200-12345, 9820012345) and store 10 digits.
     */
    protected function prepareForValidation()
    {
        $digits = preg_replace('/\D+/', '', (string) $this->input('phone_number'));
        if (strlen($digits) === 12 && substr($digits, 0, 2) === '91') {
            $digits = substr($digits, 2);
        } elseif (strlen($digits) === 11 && $digits[0] === '0') {
            $digits = substr($digits, 1);
        }

        $this->merge([
            'phone_number' => $digits,
            'name' => trim(preg_replace('/\s+/u', ' ', (string) $this->input('name'))),
        ]);
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'phone_number' => ['required', 'regex:/^[6-9][0-9]{9}$/'],
            'email' => ['nullable', 'email:rfc,filter', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'message' => ['nullable', 'string', 'max:500'],
            'model' => ['nullable', 'in:property,fre'],
            'model_id' => ['nullable', 'required_with:model', 'integer', 'min:1'],
            // Honeypot: hidden from people, filled in by bots.
            'website' => ['nullable', 'max:0'],
        ];
    }

    public function messages()
    {
        return [
            'phone_number.regex' => 'Please enter a valid 10-digit Indian mobile number.',
            'website.max' => 'Your enquiry could not be sent.',
        ];
    }

    public function attributes()
    {
        return ['phone_number' => 'mobile number'];
    }
}
