<?php

namespace App\Http\Requests;

class CalendarDayRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'dates' => 'required|array',
            'dates.*' => 'required|date',
            'clinic_id' => 'required|exists:clinics,id',
        ];
    }

    /**
     * Customizing input names displayed for user
     * @return array
     */
    public function attributes() : array
    {
        return [
            'dates' => 'التواريخ',
            'clinic_id' => 'التخصص',
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [];
    }
}
