<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Category $resource
 */
class CategoryResource extends JsonResource {
    /**
     * @param  \Illuminate\Http\Request  $request
     */
    public function toArray($request) {
        return array(
            'id'      => $this->resource->id,
            'name'    => $this->resource->name,
        );
    }
}
