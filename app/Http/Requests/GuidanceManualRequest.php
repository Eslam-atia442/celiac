<?php

namespace App\Http\Requests;

use App\Enums\HealthLibraryTypeEnum;
use App\Rules\CheckLibraryExistRule;
use Illuminate\Foundation\Http\FormRequest;

class GuidanceManualRequest extends BaseRequest
{

    protected function prepareForValidation(): void
    {
        request()->merge(['type'=> HealthLibraryTypeEnum::guidance_manual->value,]);
        $this->merge([
            'type' => HealthLibraryTypeEnum::guidance_manual->value,
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
            'type'=> 'nullable',
            'title' => ['required','string','max:150', new CheckLibraryExistRule(request()->route('guidance_manual'))],
            'file_type' => 'required|in:1,2',
            'file' =>[$this->getMethod() === 'POST' ? 'required' : 'nullable', 'file', 'mimes:pdf','max:20480']
        ];
    }
}
