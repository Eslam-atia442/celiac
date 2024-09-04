<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class ActivityLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id'      => $this->id,
            'message' => $this->description,
            'action'  => $this->getExtraProperty('action'),
            'module'  => $this->getExtraProperty('module'),
            'by'      => $this->causer?->name,
            'date'    => $this->created_at->format('Y-m-d'),
            'time'    => $this->created_at->format('H:i'),
        ];
    }
}
