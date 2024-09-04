<?php

namespace App\Http\Requests;

use App\Enums\FileEnum;
class FileRequest extends BaseRequest
{
    const MAX_FILE_SIZE = 1024 * 1024 * 10; // 10 MB

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {

        return [
            'file' => 'required|'.$this->getTypeValidation().'|max:'.self::MAX_FILE_SIZE,
            'type' => 'required|string|in:'.implode(',', FileEnum::values()),
            'fileable_id' => 'nullable|integer',
            'fileable_type' => 'nullable|string|in:'.implode(',', FileEnum::fileableTypes()),
        ];
    }

    public function getTypeValidation(): string|null
    {
         $mixed = $this->accept ?
            config('validations.file.mixed').','.str_replace('.','',$this->accept)
            : config('validations.file.mixed');

        return match(request('type')){
            FileEnum::file_type_user_avatar->value => config('validations.file.mixed'),
            default => $mixed
        };
    }
}
