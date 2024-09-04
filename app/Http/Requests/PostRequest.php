<?php

namespace App\Http\Requests;

class PostRequest extends BaseRequest
{


    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth()->id(),
            'publish_date' => now()
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => config('validations.string.req'),
            'description' => config('validations.long_text.req'),
            'user_id' => ['nullable'],
            'publish_date' => ['nullable'],
            'image' => [$this->getMethod() === 'POST' ? 'required' : 'nullable', 'image', 'mimes:png,jpg,jpeg,svg'],

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
