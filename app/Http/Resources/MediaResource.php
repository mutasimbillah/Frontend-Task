<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource {

    public function toArray($request) {
        $model = $this->resource->only([
            'file_name',
            'mime_type',
            'collection_name',
            'original_url',
        ]);
        return $model;
    }
}
