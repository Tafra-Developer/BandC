<?php

namespace App\Http\Resources;

use App\Http\Resources\LessonResource;
use Session;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeAdRescource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->type == 'normal') {
            return [
                'id' => $this->id,
                'name' => $this->title,
                'description' => $this->description,
                // 'price' => $this->price,
                // 'category' => $this->category?->name,

                'city' => $this->city?->name,
                // 'whatsapp' => $this->whatsapp,
                // 'phone' => $this->phone,
                // 'location' => [
                //     'lat' => $this->lat,
                //     'long' => $this->long,
                // ],
                // 'show_name' => $this->show_name,
                // 'contact_way' => $this->contact_way,
                'image' => asset($this->img),
                'created_at' => \Carbon\Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans(),

            ];
        } else {
            return [
                'id' => $this->id,
                // 'category' => $this->category?->name,
                // 'whatsapp' => $this->whatsapp,
                // 'phone' => $this->phone,
                'image' => asset($this->img),
            ];
        }
    }
}
