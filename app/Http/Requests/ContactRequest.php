<?php

namespace App\Http\Requests;

use App\Rules\StringInputRule;

class ContactRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:25', new StringInputRule()],
            'email' => 'required|email:rfc,dns',
            'country_code' => 'required|integer',
            'phone' => 'required|digits_between:7,15',
            'message' => 'required|min:2',
        ];
    }

    /**
     * Customizing input names displayed for user
     * @return array
     */
    public function attributes(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [];
    }
}
