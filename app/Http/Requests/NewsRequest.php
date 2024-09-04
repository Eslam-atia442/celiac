<?php

namespace App\Http\Requests;

class NewsRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:2|max:150',
            'description' => 'required|min:2|max:250',
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
