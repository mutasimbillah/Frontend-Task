<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

/**
 * @property Product $resource
 */
class ProductResource extends JsonResource {
    //
    private function getMedia($name) {
        $len = count($this->resource->media);
        $mainAt = 0;
        $allImages = $this->resource->media;
        //
        for ($i = 0; $i < $len; $i++) {
            if ($allImages[$i]->collection_name == 'feature') {
                $mainAt = $i;
                break;
            }
        }
        //
        if ($name == 'feature') {
            return MediaResource::make($allImages[$mainAt]);
        } else {
            return MediaResource::collection(Arr::except($allImages, $mainAt));
        }
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request) {
        //
        $model = $this->resource->only([
            'id',
            'name',
            'is_popular',
            'category_id',
            'price',
            'details',
        ]);
        return array_merge($model, [
            'category'    => $this->whenLoaded('category', fn () => CategoryResource::make($this->resource->category)),
            'feature' => $this->whenLoaded('media', fn () => $this->getMedia('feature')),
        ]);
    }
}
