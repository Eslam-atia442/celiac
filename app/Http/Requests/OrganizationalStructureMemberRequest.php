<?php

namespace App\Http\Requests;

use App\Enums\MemberTypeEnum;
use App\Rules\CheckMemberExistRule;


class OrganizationalStructureMemberRequest extends BaseRequest
{

    protected function prepareForValidation(): void
    {
        $this->merge([
            'type' => MemberTypeEnum::members_of_the_organizational_structure->value,
        ]);
        request()->merge(['type'=> MemberTypeEnum::members_of_the_organizational_structure->value,]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'type' =>'nullable',
            'name' => ['required','string','min:2','max:150', new CheckMemberExistRule()],
            'position_id' =>'required|integer',
            'image' => [$this->getMethod() === 'POST' ? 'required' : 'nullable', 'image', 'mimes:png,jpg,jpeg,svg'],
        ];
    }
}
