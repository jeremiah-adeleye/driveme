<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCompleteRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user() != null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'car_make' => 'string|required',
            'car_model' => 'string|required',
            'address' => 'string|required',
            'working_hour' => 'string|required',
            'occupation' => 'string|required',
            'insurance_policy' => 'string|required',
            'preferred' => 'string|required',
            'preferred_driving_city' => 'string|required',
        ];
    }
}
