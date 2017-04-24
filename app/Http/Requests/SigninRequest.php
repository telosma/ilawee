<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SigninRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'email' => 'required|exists:users',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => trans('validation.email.required'),
            'email.email' => trans('validation.email.email'),
            'email.exists' => trans('validation.email.exists'),
            'password.required' => trans('validation.password.required'),
        ];
    }

    public function all()
    {
        $attributes = parent::all();
        $attributes['email'] = strtolower(trim($attributes['email']));

        return $attributes;
    }
}
