<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClinicSettingResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->full = [
            'bmi_link'        => $this->bmi_link,
            'whatsapp_group'  => $this->whatsapp_group,
            'telegram_group'  => $this->telegram_group,
            'clinic_location' => $this->clinic_location,
            'clinic_email'    => $this->clinic_email,
        ];
        return $this->getResource();
    }
}
