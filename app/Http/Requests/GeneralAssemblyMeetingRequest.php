<?php

namespace App\Http\Requests;

use App\Enums\FileEnum;

class GeneralAssemblyMeetingRequest extends BaseRequest
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
            'custom_name'=> 'nullable',
            'name' => 'required|string',
            'file' => $this->getMethod() === 'POST' ? 'required|file|mimes:pdf' : 'nullable',
        ];
    }
}
