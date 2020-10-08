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
            'car_make' => 'required|string',
            'car_model' => 'required|string',
            'address' => 'required|string',
            'working_hour' => 'required|string',
            'occupation' => 'required|string',
            'insurance_policy' => 'required|string',
            'preferred_driving_city' => 'required|string',
            'driver_class_type' => 'required|string',
        ];
    }
}
