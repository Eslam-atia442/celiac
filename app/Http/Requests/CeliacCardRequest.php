<?php

namespace App\Http\Requests;

use App\Enums\CeliacCardStatusEnum;
use Illuminate\Validation\Rule;

class CeliacCardRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in([CeliacCardStatusEnum::accepted->value, CeliacCardStatusEnum::rejected->value])],
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
