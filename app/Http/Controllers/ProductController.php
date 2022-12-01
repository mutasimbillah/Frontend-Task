<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends ApiController {
    //
    public function index() {
        $products = QueryBuilder::for(Product::class)
            ->allowedFilters([
                AllowedFilter::exact('is_popular'),
                AllowedFilter::exact('category_id'),
            ])
            ->allowedIncludes(['category', 'media'])
            ->get();
        //return $products;
        return $this->success(ProductResource::collection($products));
    }

    public function show(Product $product) {
        $product->getMedia();
        return $this->success(ProductResource::make($product));
    }
}
