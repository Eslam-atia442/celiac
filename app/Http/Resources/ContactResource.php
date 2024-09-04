<?php

namespace App\Http\Resources;


use Carbon\Carbon;
use \Illuminate\Http\Request;

class ContactResource extends BaseResource
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
            'id'      => $this->id,
            'name'    => $this->name,
            'message' => $this->message,
        ];
        $this->mini = [
        ];
        $this->full = [
            'country_code' => $this->country_code,
            'email'        => $this->email,
            'phone'        => $this->phone,
            'created_at'   => Carbon::parse($this->created_at)->translatedFormat(config('app.date_format'))
        ];
        return $this->getResource();
    }
}
