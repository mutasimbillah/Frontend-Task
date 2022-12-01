<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model  implements HasMedia {
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $guarded = [];

    public function registerMediaConversions(Media $media = null): void {
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150);
    }

    public function registerMediaCollections(): void {
        $this->addMediaCollection('feature')->singleFile();
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
