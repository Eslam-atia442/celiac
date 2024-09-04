<?php

namespace App\Http\Requests\api;

use App\Enums\GenderEnum;
use App\Rules\KsaPhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JobRequestRequest extends FormRequest
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
            'full_name'        => [ 'required', 'string', 'min:3', 'max:100' ],
            'phone'            => [ 'required' ],
            'email'            => [ 'required', 'email' ],
            'dob'              => [ 'required', 'date' ],
            'is_saudi'         => [ 'required', 'boolean' ],
            'is_infected'      => [ 'required', 'boolean' ],
            'residency_number' => [
                'nullable', 'string', Rule::requiredIf(function () {
                    return $this->is_saudi == false;
                })
            ],
            'national_id'      => [
                'nullable', 'string', Rule::requiredIf(function () {
                    return $this->is_saudi == true;
                })
            ],
            'city'          => [ 'required', 'string' ],
            'gender'           => [ 'required', Rule::in([ GenderEnum::male->value, GenderEnum::female->value ]) ],
            'cv'   => [ 'required', 'file', 'mimes:pdf,jpg' ]
        ];
    }
}
