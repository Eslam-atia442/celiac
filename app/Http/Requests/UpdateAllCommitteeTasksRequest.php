<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAllCommitteeTasksRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'committees'=> 'required|array',
            'committees.*.id'=> 'required|exists:committees,id',
            'committees.*.tasks'=> config('validations.text.req'),
        ];
    }
}
