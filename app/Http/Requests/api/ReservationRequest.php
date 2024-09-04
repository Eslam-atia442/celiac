<?php

namespace App\Http\Requests\api;

use App\Enums\GenderEnum;
use App\Enums\ReservationTypeEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReservationRequest extends BaseRequest
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
            'clinic_id' => ['required', Rule::exists('clinics', 'id')],
            'type' => ['required', 'integer','in:'.implode(',',ReservationTypeEnum::values())],
            'scheduled_date' => ['required', 'date'],
            'scheduled_time' => ['required', 'date_format:H:i'],
            'patient_name' => ['required', 'string'],
            'patient_phone' => ['required', 'string'],
            'gender' => ['required', 'integer','in:'.implode(',',GenderEnum::values())],
            'email' => ['required', 'string'],
            'dob' => ['required', 'date'],
            'is_saudi' => ['required', 'boolean'],
            'national_id' => ['nullable', 'string',Rule::requiredIf(function () {
                return $this->is_saudi == true;
            })],
            'residency_number' => ['nullable', 'string',Rule::requiredIf(function () {
                return $this->is_saudi == false;
            })]
        ];
    }
}
