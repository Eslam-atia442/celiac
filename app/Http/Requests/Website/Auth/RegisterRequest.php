<?php

namespace App\Http\Requests\Website\Auth;

use App\Enums\BooleanEnum;
use App\Rules\KsaPhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'                  => ['required', 'string', 'min:3', 'max:25'/*, 'regex:/^[a-zA-Z]+$/'*/],
            'phone'                 => ['required', new KsaPhoneNumber(), Rule::unique('users', 'phone') ],
            'email'                 => ['required', 'email', Rule::unique('users', 'email')],
            'birthdate'             => ['required', 'date', 'before:today'],
            'is_saudi'              => ['required', 'boolean'],
            'civil_id'              => ['required_if:is_saudi,1', 'numeric', 'digits:10'],
            'residency_number'      => ['required_if:is_saudi,0', 'numeric', 'digits_between:9,15'],
            'password'              => [
                                        'required',
                                        'confirmed',
                                        Password::min(6)
                                            ->mixedCase()
                                            ->letters()
                                            ->numbers()
                                            ->symbols(),
                                        ],
            'password_confirmation' => ['required'],
            'terms_and_conditions'  => ['required'],


        ];
    }

    public function messages()
    {
        return [
            'civil_id.required_if' => __('validation.civil_id_required_if'),
            'residency_number.required_if' => __('validation.residency_number_required_if'),
            'phone.unique' => __('messages.validation.phone_website_exists_register'),

        ];

    }
}
