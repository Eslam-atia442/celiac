<?php

namespace App\Http\Requests;

use App\Enums\GenderEnum;
use App\Enums\ReservationTypeEnum;
use Illuminate\Validation\Rule;

class ReservationRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'type' => ['required', 'integer','in:'.implode(',',ReservationTypeEnum::values())],
            'scheduled_at' => ['required', 'date'],
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

    /**
     * Customizing input names displayed for user
     * @return array
     */
    public function attributes() : array
    {
        return [];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [];
    }
}
