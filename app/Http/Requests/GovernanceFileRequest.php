<?php

namespace App\Http\Requests;

use App\Enums\FileEnum;

class GovernanceFileRequest extends BaseRequest
{
    protected function prepareForValidation(): void
    {

        $this->merge([
            'custom_name' => request()->name,
        ]);

    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => config('validations.string.req'),
            'governance_list_id' =>'required|exists:governance_lists,id',
            'file' => [$this->getMethod() === 'POST' ? 'required' : 'nullable', 'file', 'mimes:pdf'],
            'custom_name'=> 'nullable',
        ];
    }
}
