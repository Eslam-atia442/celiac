<?php

namespace App\Http\Requests;

class PartnerRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => config('validations.string.req'),
            'partner_group_id' => sprintf(config('validations.model.req'), 'partner_groups'),
            'image' => $this->getMethod() === 'POST' ? 'required|' : 'nullable|' . config('validations.file.image'),

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
