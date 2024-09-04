<?php

namespace App\Http\Requests;

use App\Enums\GenderEnum;
use Illuminate\Validation\Rule;

class FoodBasketRequestRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'full_name'        => [ 'required', 'string', 'min:3', 'max:100' ],
            'phone'            => [ 'required' ],
            'email'            => [ 'required', 'email' ],
            'dob'              => [ 'required', 'date' ],
            'is_saudi'         => [ 'required', 'boolean' ],
            'is_visitor'       => [ 'required', 'boolean' ],
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
            'address'          => [ 'required', 'string', 'min:3', 'max:200' ],
            'gender'           => [ 'required', Rule::in([ GenderEnum::male->value, GenderEnum::female->value ]) ],
            'file'             => [ 'required', 'file' ],
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
