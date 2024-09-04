<?php

namespace App\Http\Requests;

use App\Rules\KsaPhoneNumber;
use App\Rules\StringInputRule;

class MedicalConsultingRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:100', new StringInputRule()],
            'email' => 'required|email:rfc,dns',
            'country_code' => 'required|integer',
            'phone' => ['required', new KsaPhoneNumber() ],
            'birthdate' => 'required|date|before:today',
            'civil_id' => 'required|numeric|digits:10',
            'consulting' =>'required|string|max:1000',
            'gender' => 'required|in:0,1',
            'reply_user_id'=> 'nullable'
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
