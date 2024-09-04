<?php

namespace App\Http\Resources;


use \Illuminate\Http\Request;

class JobRequestResource extends BaseResource
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
            'id' => $this->id,
        ];
        $this->mini = [
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
        $this->full = [
            'user_id'          => $this->user_id,
            'status'           => $this->status,
            'full_name'        => $this->full_name,
            'email'            => $this->email,
            'phone'            => $this->phone,
            'city'             => $this->city,
            'dob'              => $this->dob,
            'is_saudi'         => $this->is_saudi,
            'is_infected'      => $this->is_infected,
            'residency_number' => $this->residency_number,
            'national_id'      => $this->national_id,
            'gender'           => $this->gender
        ];
        //$this->relationLoaded()
        $this->relations = [
            'cv'   => $this->relationLoaded('cv') ? new FileResource($this->cv) : null,
            'user' => $this->relationLoaded('user') ? new UserResource($this->user) : null
        ];
        return $this->getResource();
    }
}
