<?php

namespace App\Http\Resources;


use Carbon\Carbon;
use \Illuminate\Http\Request;

class MemberResource extends BaseResource
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
            'id'            => $this->id,
            'name'          => $this->name,
            'position_name' => $this->getPositionName(),
            'type'          => $this->type,
            'type_text'     => $this->type->label(),
        ];

        $this->mini = [
            'period'             => $this->period,
            'start_date'         => $this->start_date,
            'end_date'           => $this->start_date ? Carbon::parse($this->start_date)->addMonths($this->period)->toDateString() : '',
            'member_period_text' => $this->member_period_text,
        ];

        $this->full = [
            'is_active'     => $this->is_active,
            'active_class'  => $this->active_class,
            'active_status' => $this->active_status
        ];
        $this->relations = [
            'image'     => $this->relationLoaded('image') ? new FileResource($this->whenLoaded('image')) : null,
            'position'  => $this->relationLoaded('position') ? new PositionResource($this->whenLoaded('position')) : null,
            'committee' => $this->relationLoaded('committable') ? new CommitteeResource($this->whenLoaded('committable')) : null,
        ];
        return $this->getResource();
    }

    public function getPositionName()
    {
        if ($this->relationLoaded('committable') && !empty($this->committable)) {
            return __("member") . ' ' . $this->committable->name;
        }
        return $this->relationLoaded('position') ? $this->position?->name : '';
    }
}
