<?php

namespace App\Http\Requests\api;

use Illuminate\Foundation\Http\FormRequest;

class CalendarDayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'clinic_id' => 'required|exists:clinics,id',
            'day_date' => 'required|date',
//            'month' => 'nullable|integer|min:1|max:12'
        ];
    }
}
