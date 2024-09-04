<?php

namespace App\Http\Resources;


use \Illuminate\Http\Request;

class ClinicResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        $this->micro = [
            'id'                => $this->id,
            'name'              => $this->name,
            'number_of_doctors' => $this->number_of_doctors,
            'duration'          => $this->duration,
            'shift_type'        => $this->shift_type,
            'location'          => $this->location,
            'start_time'        => $this->start_time,
            'end_time'          => $this->end_time,

        ];
        $this->mini = [
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
        $this->full = [
            'calendar_days' => $this->relationLoaded('calendarDays') ? CalendarDayResource::collection($this->calendarDays) : null
        ];
        //$this->relationLoaded()
        $this->relations = [
        ];
        return $this->getResource();
    }
}
