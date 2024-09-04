<?php

namespace App\Http\Requests;

use App\Enums\MemberTypeEnum;
use App\Rules\CheckMemberExistRule;

class BoardMemberRequest extends BaseRequest
{

    protected function prepareForValidation(): void
    {
        request()->merge(['type'=> MemberTypeEnum::board_of_directors->value,]);
        $this->merge([
            'type' => MemberTypeEnum::board_of_directors->value,
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
            'type' =>'nullable',
            'period'=> 'required|integer|min:1',
            'start_date' =>'required|date',
            'name' => ['required','string','min:2','max:150', new CheckMemberExistRule()],
            'position_id' =>'required|integer',
            'image' => [$this->getMethod() === 'POST' ? 'required' : 'nullable', 'image', 'mimes:png,jpg,jpeg,svg'],
        ];

    }
}
