<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends ApiController {
    //
    public function index() {
        $categories = QueryBuilder::for(Category::class)
            ->allowedFilters([
                AllowedFilter::exact('shop_id'),
            ])
            ->allowedIncludes(['shop'])
            ->get();
        return $this->success(CategoryResource::collection($categories));
    }

    public function show(Category $category) {
        return $this->success(CategoryResource::make($category));
    }
}
