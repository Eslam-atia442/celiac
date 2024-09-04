<?php

namespace App\Http\Requests;

use App\Enums\PatientAwarenessArticleTypeEnum;
use App\Enums\PatientAwarenessContentTypeEnum;
use App\Enums\PatientAwarenessTypeEnum;
use Illuminate\Validation\Rule;

class PatientAwarenessRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */


    public function prepareForValidation()
    {
        if (request()->has('type')) {
            if (request()->type == PatientAwarenessTypeEnum::file->value) {
                request()->article_type = null;
                request()->description = null;
                request()->link = null;
                request()->type_text = null;
            }elseif(request()->type == PatientAwarenessTypeEnum::video->value) {
                request()->article_type = null;
                request()->link = null;
                request()->type_text = null;
            }

        }

    }


    public function rules(): array
    {
        return [
            'type' => 'required | in:' . implode(',', PatientAwarenessTypeEnum::values()),
            'content_type' => ['required', 'in:' . implode(',', PatientAwarenessContentTypeEnum::values())],
            'article_type' => ['nullable', Rule::requiredIf(in_array(@request()->type, [PatientAwarenessTypeEnum::article->value])),  'in:' . implode(',', PatientAwarenessArticleTypeEnum::values()), 'required_if:type,' . PatientAwarenessTypeEnum::article->value],
            'title' => 'required',
            'description' => ['nullable', Rule::requiredIf(in_array(@request()->type, [PatientAwarenessTypeEnum::article->value, PatientAwarenessTypeEnum::video->value]) )],
            'type_text' => ['nullable', Rule::requiredIf(in_array(@request()->type, [PatientAwarenessTypeEnum::article->value]) && @request()->article_type == PatientAwarenessArticleTypeEnum::text->value)],
            'link' =>['nullable', Rule::requiredIf(in_array(@request()->type, [PatientAwarenessTypeEnum::article->value]) && @request()->article_type == PatientAwarenessArticleTypeEnum::link->value),'url'],
            'image' => [$this->getMethod() === 'POST' ? 'required' : 'nullable', 'image', 'mimes:png,jpg,jpeg,svg'],
            'pdf' =>[$this->getMethod() === 'POST' ? 'nullable' : 'nullable', 'file', 'mimes:pdf','max:20480'],
        ];
    }

    /**
     * Customizing input names displayed for user
     * @return array
     */
    public function attributes() : array
    {
        return [];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [];
    }
}
