<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class BannerRequest extends BaseRequest
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
            'description' => config('validations.long_text.null'),
            'url' => config('validations.url.req'),
            'image' => [$this->getMethod() === 'POST' ? 'required' : 'nullable', 'image', 'mimes:png,jpg,jpeg,svg', 'min:1024', 'max:10240'],
            'is_active' => ['required',Rule::in([0, 1])],
        ];
    }

    /**
     * Customizing input names displayed for user
     * @return array
     */
    public function attributes(): array
    {
        return [

        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [];
    }
}
