<?php

namespace App\Http\Requests;

use App\Enums\MemberTypeEnum;
use Carbon\Carbon;

class OrganizationalStructureRequest extends BaseRequest
{

    protected function prepareForValidation(): void
    {
        $this->merge([
            'type' => MemberTypeEnum::members_of_the_organizational_structure->value,
            'folder'=> config('filesystems.upload.paths.organizational_structure_members'),
            'end_date'=> Carbon::parse(request('start_date'))->addMonths(request('period')),
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
            'folder' =>'nullable',
            'end_date'=> 'nullable',
            'period'=> 'required|integer|min:1',
            'start_date' =>'required|date',
            'name' =>'required|string|min:2|max:255',
            'position_id' =>'required|integer',
            'image' => [$this->getMethod() === 'POST' ? 'required' : 'nullable', 'image', 'mimes:png,jpg,jpeg'],
        ];
    }
}
