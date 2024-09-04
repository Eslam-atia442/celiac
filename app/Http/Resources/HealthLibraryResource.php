<?php

namespace App\Http\Resources;


use Carbon\Carbon;
use \Illuminate\Http\Request;

class HealthLibraryResource extends BaseResource
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
            'id'    => $this->id,
            'title' => $this->title,
        ];

        $this->mini = [
            'type'             => $this->type,
            'type_text'        => $this->type?->label(),
            'file_type'        => $this->file_type,
            'file_type_text'   => $this->file_type?->label(),
            'description'      => $this->description,
            'author_name'      => $this->author_name,
            'publication_date' => Carbon::parse($this->created_at)->translatedFormat(config('app.date_format')),
        ];

        $this->full = [
            'is_active'     => $this->is_active,
            'active_class'  => $this->active_class,
            'active_status' => $this->active_status
        ];
        //$this->relationLoaded()
        $this->relations = [
            'image' => $this->relationLoaded('image') ? new FileResource($this->whenLoaded('image')) : null,
            'file'  => $this->relationLoaded('file') ? new FileResource($this->whenLoaded('file')) : null,
        ];
        return $this->getResource();
    }
}
