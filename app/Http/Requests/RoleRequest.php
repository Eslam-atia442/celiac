<?php

namespace App\Http\Requests;

use App\Rules\StringInputRule;
use Illuminate\Validation\Rule;

class RoleRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
         return [
            'name' => ['required', 'string', 'min:3', 'max:20',
                Rule::unique('roles')->ignore($this->role->id ?? null),
                new StringInputRule(),
            ],
            'role_permissions' => 'required|array',
        ];
    }
}
