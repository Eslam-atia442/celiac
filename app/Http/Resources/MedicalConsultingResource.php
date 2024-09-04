<?php

namespace App\Http\Resources;


use \Illuminate\Http\Request;

class MedicalConsultingResource extends BaseResource
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
            'id'         => $this->id,
            'name'       => $this->name,
            'consulting' => $this->consulting,
        ];
        $this->mini = [
            'email'        => $this->email,
            'country_code' => $this->country_code,
            'phone'        => $this->phone,
            'civil_id'     => $this->civil_id,
        ];
        $this->full = [
            'birthdate'     => $this->birthdate,
            'gender'        => $this->gender,
            'reply_message' => $this->reply_message,
            'is_reply'      => $this->is_reply,
            'reply_user_id' => $this->reply_user_id,
            'reply_class'   => $this->reply_class,
            'reply_status'  => $this->reply_status
        ];
        //$this->relationLoaded()
        $this->relations = [
            'replyUser' => $this->relationLoaded('replyUser') ? new UserResource($this->whenLoaded('replyUser')) : null,
        ];
        return $this->getResource();
    }
}
