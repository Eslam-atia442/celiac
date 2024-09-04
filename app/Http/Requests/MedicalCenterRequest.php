<?php

namespace App\Http\Requests;

use App\Enums\MedicalCenterTypeEnum;
use Illuminate\Validation\Rule;

class MedicalCenterRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'type'        => [ 'required', Rule::in(MedicalCenterTypeEnum::video->value, MedicalCenterTypeEnum::book->value) ],
            'title'       => 'required|string|max:150',
            'author_name' => [ 'nullable', 'string', 'max:150', Rule::requiredIf($this->type == MedicalCenterTypeEnum::book->value) ],
            'description' => [ 'nullable', 'string', 'max:500', Rule::requiredIf($this->type == MedicalCenterTypeEnum::book->value) ],
            'video_url'   => [ 'nullable', 'url', Rule::requiredIf($this->type == MedicalCenterTypeEnum::video->value) ],
            'video_type'  => [
                'nullable',
                Rule::requiredIf($this->type == MedicalCenterTypeEnum::video->value),
                Rule::in([ 'X spaces', 'podcast episodes', 'scientific interviews', 'cooking series' ])
            ],
            'image'       => [ 'nullable', 'image', 'mimes:png,jpg,jpeg,svg', Rule::requiredIf($this->type == MedicalCenterTypeEnum::book->value) ],
            'pdf'         => [ 'nullable', 'file', 'mimes:pdf', 'max:20480', Rule::requiredIf($this->type == MedicalCenterTypeEnum::book->value) ],
        ];
    }

    protected function passedValidation(): void
    {
        if ($this->type == MedicalCenterTypeEnum::book->value) {
            $this->merge([
                'video_url' => null
            ]);
        }
        if ($this->type == MedicalCenterTypeEnum::video->value) {
            $this->merge([
                'author_name' => null,
                'description' => null,
                'pdf'         => null,
                'image'       => null,
            ]);
        }

    }

    /**
     * Customizing input names displayed for user
     * @return array
     */
    public function attributes(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'video_type.in' => 'The video type must be one of the following: X spaces, podcast episodes, scientific interviews, cooking series',
        ];
    }
}
