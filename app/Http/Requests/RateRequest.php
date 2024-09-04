<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class RateRequest extends BaseRequest
{



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'reservation_id' => ['required',Rule::exists('reservations','id')->where('user_id',auth()->id())],
            'rate' => 'required|numeric|min:1|max:5',
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
