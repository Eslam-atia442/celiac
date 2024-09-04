<?php

namespace App\Http\Requests\Website\Auth;

use App\Enums\BooleanEnum;
use App\Enums\UserTypeEnum;
use App\Rules\KsaPhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class CodeValidateRequest extends FormRequest
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
            'code' => [
                'required',
                Rule::exists('password_reset_tokens', 'code')->where(function ($query) {
                    $query->where('created_at', '>', now()->subMinutes(1));
                }),
            ],
        ];
    }

    public function messages()
    {
        return [
            'code.exists' => __('messages.validation.code_website_exists'),
        ];

    }
}
