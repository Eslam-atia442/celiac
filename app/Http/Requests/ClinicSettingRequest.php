<?php

namespace App\Http\Requests;


class ClinicSettingRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'bmi_link'=> 'required|string|url',
            'whatsapp_group'=> 'required|string|url',
            'telegram_group'=> 'required|string|url',
            'clinic_email'=> 'required|email:rfc,dns',
            'clinic_location'=> 'required|string|url',
        ];
    }
}
