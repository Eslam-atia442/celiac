<?php

namespace App\Http\Requests;


class AboutSettingRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'association_about_title'=> 'required|string|min:6|max:500',
            'association_about_description'=> 'required|string|min:6|max:500',
            'establishment_of_the_association'=> 'required|string|min:6|max:500',
            'association_visions'=> 'required|string|min:6|max:500',
            'association_message'=> 'required|string|min:6|max:500',
            'association_objectives'=> 'required|string|min:6|max:500',
            'association_values'=> 'required|string|min:6|max:500',
//            'about_image'=> 'required|string|min:6|max:500',
        ];
    }
}
