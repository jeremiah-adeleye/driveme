<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverRequest extends FormRequest
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
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'phoneNumber' => 'required|string|max:11|unique:users',
            'dateOfBirth' => 'required|date',
            'location' => 'required|string',
            'SalaryRange' => 'required',
            'password' => [
                'required|string|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/|confirmed'
            ],
            'address' => 'required|string',
            'licenceNumber' => 'required|string',
            'experience' => 'required',
        ];
    }
}
