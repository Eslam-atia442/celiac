<?php

namespace App\Http\Resources;

use App\Traits\HelperTrait;
use Carbon\Carbon;
use Illuminate\Support\Str;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FileResource extends BaseResource
{
    use HelperTrait;

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        $this->micro = [
            'id'          => $this->id,
            //            'name'=> $this->original_name,
            'name'        => $this->custom_name ?? $this->name,
            'file_name'   => $this->name,
            'size'        => $this->size ? $this->formatSizeUnits($this->size) : '',
            'url'         => Storage::url($this->url),
            'fileable_id' => $this->fileable_id
        ];

        $this->mini = [
            'type'     => $this->type,
            'datetime' => $this->created_at ? $this->created_at->format('d M, Y H:i') : '',
            'date'     => $this->date ? Carbon::parse($this->date)->translatedFormat(config('app.date_format')) : Carbon::parse($this->created_at)->translatedFormat(config('app.date_format')),
        ];

        $this->full = [
            'mime'       => $this->mime,
            'width'      => $this->when(Str::contains($this->mime, 'image'), $this->width),
            'height'     => $this->when(Str::contains($this->mime, 'image'), $this->height),
            'created_at' => $this->created_at ? $this->created_at->format(config('app.datetime_format')) : '',
            'ext'        => $this->ext,
            'duration'   => $this->duration,
            'path'       => '/storage/' . $this->url,
            'notes'      => $this->notes,
            'is_active'  => $this->is_active,
        ];

        $this->relations = [
//            'user' => $this->relationLoaded('user') ? new UserResource($this->whenLoaded('user')) : null,
        ];

        return $this->getResource();
    }
}
