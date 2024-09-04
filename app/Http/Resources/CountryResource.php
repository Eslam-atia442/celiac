<?php

namespace App\Http\Resources;


use App\Models\Country;
use \Illuminate\Http\Request;

class CountryResource extends BaseResource
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
            'id'                         => $this->id,
            'iso_alpha_3'                => $this->iso_alpha_3,
            'international_phone'        => $this->international_phone,
            'official_name'              => $this->official_name,
            'international_phone_with_+' => '+' . $this->international_phone,
            'image'                      => url('/UI/assets/countries/3x2/' . $this->iso_alpha_2 . '.svg'),
            'color_rgb'                  => json_decode($this->color_rgb),
            'color_hex'                  => json_decode($this->color_hex),
        ];
        $this->mini = [
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
        $this->full = [
            'is_active'     => $this->is_active,
            'active_class'  => $this->active_class,
            'active_status' => $this->active_status
        ];
        //$this->relationLoaded()
        $this->relations = [
        ];
        return $this->getResource();
    }
}
