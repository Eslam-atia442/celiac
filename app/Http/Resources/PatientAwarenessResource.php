<?php

namespace App\Http\Resources;


use \Illuminate\Http\Request;

class PatientAwarenessResource extends BaseResource
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
            'title'             => $this->title,
            'content_type_text' => $this->content_type_text,
            'content_type'      => $this->content_type,
            'article_type_text' => $this->article_type_text,
            'article_type'      => $this->article_type,
            'type_text'         => $this->type_text,
            'type'              => $this->type,
            'description'       => $this->description,
            'file'              => $this->file,
            'link'              => $this->link,
            'image'             => $this->relationLoaded('image') ? new FileResource($this->whenLoaded('image')) : '',
            'pdf'               => $this->relationLoaded('pdf') ? new FileResource($this->whenLoaded('pdf')) : '',
        ];
        //$this->relationLoaded()
        $this->relations = [
        ];
        return $this->getResource();
    }
}
