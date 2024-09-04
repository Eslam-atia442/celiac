<?php

namespace App\Http\Resources;


use \Illuminate\Http\Request;

class CalendarDayResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {

        $this->full = [
            'day_date'           => $this->day_date_hijri,
            'day_date_gregorian' => $this->day_date,
            'clinic_id'          => $this->clinic_id,
            'available_times'    => $this->getAvailableTimes(),
        ];

        $this->relations = [
//            'clinic' =>  $this->relationLoaded('clinic') ? new ClinicResource($this->clinic) : null
        ];
        return $this->getResource();
    }
}
