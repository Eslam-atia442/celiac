<?php

namespace App\Http\Requests;

class GeneralSettingRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email'=> 'required|email',
            'address'=> 'required|min:2|max:100',
            'phone'=> 'required|string',
            'phone1'=> 'required|string',
            'youtube'=> 'required|string|url',
            'twitter'=> 'required|string|url',
            'whatsapp'=> 'required|string|url',
            'facebook'=> 'required|string|url',
            'tiktok'=> 'required|string|url',
        ];
    }
}
