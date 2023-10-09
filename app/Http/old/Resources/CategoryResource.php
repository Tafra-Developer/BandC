<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'name' => $this->name,
            'image' => asset($this->Img),
            $this->mergeWhen($request->route()->getName() == 'category.show', [
                'brands' => BrandResource::collection($this->brands()->limit(5)->get()),
                'subCategories' => HomeCategoryResource::collection($this->children()->limit(5)->get()),
                'ads' => HomeAdRescource::collection($this->allReletedAds()),
            ]),

        ];
    }
}
