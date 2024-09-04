<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class GeneralSettingResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->mini = [
            'email'    => $this->email,
            'address'  => $this->address,
            'phone'    => $this->phone,
            'phone1'   => $this->phone1,
            'tiktok'   => $this->tiktok,
            'twitter'  => $this->twitter,
            'youtube'  => $this->youtube,
            'whatsapp' => $this->whatsapp,
            'facebook' => $this->facebook,
        ];

        return $this->getResource();
    }
}
