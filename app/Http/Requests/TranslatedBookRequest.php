<?php

namespace App\Http\Requests;

use App\Enums\HealthLibraryTypeEnum;
use App\Rules\CheckLibraryExistRule;
use Illuminate\Foundation\Http\FormRequest;

class TranslatedBookRequest extends BaseRequest
{
    protected function prepareForValidation(): void
    {
        request()->merge(['type'=> HealthLibraryTypeEnum::translated_book->value,]);
        $this->merge([
            'type' => HealthLibraryTypeEnum::translated_book->value,
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
            'title' => ['required','string','max:150', new CheckLibraryExistRule(request()->route('translated_book'))],
            'author_name' => 'required|string|max:25',
            'description' => 'nullable|max:250',
            'image' => ['nullable','image', 'mimes:jpg,jpeg,png', 'max:10240'],
            'file' =>[$this->getMethod() === 'POST' ? 'required' : 'nullable', 'file', 'mimes:pdf','max:20480']
        ];
    }
}
