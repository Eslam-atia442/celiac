<?php

namespace App\Http\Resources;


use Carbon\Carbon;
use \Illuminate\Http\Request;

class CeliacCardResource extends BaseResource
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
            // get created_at in format 24 may 2022 in arabic
            'created_at' => Carbon::parse($this->created_at)->format('d M Y')
        ];
        $this->full = [
            'full_name'        => $this->full_name,
            'phone'            => $this->phone,
            'email'            => $this->email,
            'dob'              => $this->dob,
            'is_saudi'         => $this->is_saudi,
            'residency_number' => $this->residency_number,
            'national_id'      => $this->national_id,
            'address'          => $this->address,
            'gender'           => $this->gender,
            'status'           => $this->status,
        ];
        //$this->relationLoaded()
        $this->relations = [
            'medical_report' => $this->relationLoaded('medicalReport') ? new FileResource($this->medicalReport) : null,
            'user'           => $this->relationLoaded('user') ? new UserResource($this->user) : null
        ];
        return $this->getResource();
    }
}
