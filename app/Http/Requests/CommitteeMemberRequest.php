<?php

namespace App\Http\Requests;

use App\Enums\MemberTypeEnum;
use App\Rules\CheckMemberExistRule;

class CommitteeMemberRequest extends BaseRequest
{

    protected function prepareForValidation(): void
    {
        $this->merge([
            'type' => MemberTypeEnum::members_of_committee->value,
            'committable_id' => $this->committee->id,
            'committable_type' => class_basename($this->committee),
        ]);
        request()->merge(['type'=> MemberTypeEnum::members_of_committee->value,]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'type' => 'nullable',
            'committable_type' => 'nullable',
            'committable_id' => 'nullable|exists:committees,id',
            'name' => ['required','string','min:2','max:150', new CheckMemberExistRule()],
            'position_id' =>'nullable|integer',
            'image' => [$this->getMethod() === 'POST' ? 'required' : 'nullable', 'image', 'mimes:png,jpg,jpeg,svg'],
        ];
    }
}
