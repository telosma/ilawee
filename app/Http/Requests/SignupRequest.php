<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'name' => 'required|max:40',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('validation.name.required'),
            'email.required' => trans('validation.email.required'),
            'email.unique' => trans('validation.email.unique'),
            'email.email' => trans('validation.email.email'),
            'password.required' => trans('validation.password.required'),
            'password.min' => trans('validation.password.min'),
            'password.confirmed' => trans('validation.password.confirmed')
        ];
    }

    public function all()
    {
        $attributes = parent::all();
        $attributes['email'] = strtolower(trim($attributes['email']));

        return $attributes;
    }
}
