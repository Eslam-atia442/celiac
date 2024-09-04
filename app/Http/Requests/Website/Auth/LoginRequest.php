<?php

namespace App\Http\Requests\Website\Auth;

use App\Enums\BooleanEnum;
use App\Enums\UserTypeEnum;
use App\Rules\KsaPhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class LoginRequest extends FormRequest
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
            'phone' => ['required'],
            'password' => ['required'],
            'remember_me' => ['nullable', 'boolean']
        ];
    }

    public function messages()
    {
        return [
            'phone.exists' => __('messages.validation.phone_website_exists'),
        ];

    }
}
