<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TourResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'destination_id' => $this->destination_id,
            'type_id' => $this->type_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'duration' => $this->duration,
            'price' => $this->price,
            'status' => $this->status,
            'trending' => $this->trending,
            'image' => $this->image,
            'overview' => $this->overview,
            'video' => $this->video,
            'image_360' => $this->image_360,
            'additional' => $this->additional,
            'map' => $this->map,
            'departure' => $this->departure,
            'include' => $this->include,
            'is_interested' => $this->is_interested,
            'is_culture' => $this->is_culture,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description
        ];
    }
}
