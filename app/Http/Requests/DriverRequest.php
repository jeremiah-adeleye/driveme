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
            'email' => 'required|string|email|max:255|unique:users,email,'.auth()->id().'',
            'phone_number' => 'required|string|max:11|unique:users,phone_number,'.auth()->id().'',
            'dob' => 'required|date',
            'state' => 'required|string',
            'salary_range' => 'required',
            'address' => 'required|string',
            'licence_number' => 'required|string',
            'experience' => 'required|numeric',
            'vehicle_type' => 'required',
            'cv' => 'mimetypes:application/pdf|required',
            'passport' => 'image|required',
            'guarantor_name' => 'required',
            'guarantor_email' => 'email|required',
            'guarantor_phone_number' => 'string|required',
            'guarantor_relationship' => 'string|required',
            'guarantor_residential_address' => 'string|required',
            'guarantor_state_of_residence' => 'string|required',
            'guarantor_work_address' => 'string|required',
            'guarantor_passport' => 'image|required'
        ];
    }

    public function messages(){
        return [
            'password.regex' => 'Password must contain at least an uppercase, lowercase, number and special character',
            'string' => 'Field is required'
        ];
    }
}
