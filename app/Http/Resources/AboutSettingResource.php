<?php

namespace App\Http\Resources;

use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutSettingResource extends BaseResource
{
    use HelperTrait;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->mini = [
            'association_about_title'          => $this->translateSettingColumn($this, 'association_about_title'),
            'association_about_description'    => $this->translateSettingColumn($this, 'association_about_description'),
            'establishment_of_the_association' => $this->translateSettingColumn($this, 'establishment_of_the_association'),
            'association_visions'              => $this->translateSettingColumn($this, 'association_visions'),
            'association_message'              => $this->translateSettingColumn($this, 'association_message'),
            'association_objectives'           => $this->translateSettingColumn($this, 'association_objectives'),
            'association_values'               => $this->translateSettingColumn($this, 'association_values'),
            'about_image'                      => $this->about_image ? Storage::url($this->about_image) : '',
        ];

        return $this->getResource();
    }
}
