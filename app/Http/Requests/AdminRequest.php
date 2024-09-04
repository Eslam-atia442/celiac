<?php

namespace App\Http\Requests;


use App\Rules\StringInputRule;
use App\Rules\CheckAdminExistRule;

class AdminRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $isUpdate = $this->isMethod('put');
        return [
            'name' => ['required', 'string', 'min:3', 'max:25', new StringInputRule()],
            'password' => [$isUpdate ? 'nullable' : 'required', 'string', 'min:8', 'max:25'],
            'email' => ['required', 'email:rfc,dns', new CheckAdminExistRule()],
            'role_id' => ['required', 'exists:roles,id'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:10240'],
        ];
    }
}
