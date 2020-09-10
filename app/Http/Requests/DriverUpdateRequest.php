<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverUpdateRequest extends FormRequest
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
            'location' => 'required|string',
            'salary_range' => 'required',
            'address' => 'required|string',
            'licence_number' => 'required|string',
            'experience' => 'required|numeric',
            'vehicle_type' => 'required',
            'cv' => 'mimetypes:application/pdf',
            'passport' => 'image',
        ];
    }

    public function messages(){
        return [
            'cv.mimetypes' => 'Invalid format: CV must be in PDF format',
        ];
    }
}
