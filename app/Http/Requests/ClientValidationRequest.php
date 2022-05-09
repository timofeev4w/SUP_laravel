<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientValidationRequest extends FormRequest
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
            'secondname' => 'required|max:55',
            'firstname' => 'required|max:55',
            'patronymic' => 'required|max:55',
            'city' => 'required|max:55',
            'address' => 'required|max:255',
            'email' => 'required|max:100|email',
            'phone' => 'required|size:12'
            // 'email' => 'required|max:100|email|unique:clients',
            // 'phone' => 'required|size:12|unique:clients'
        ];
    }
}
