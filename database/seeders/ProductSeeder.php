<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use App\Models\Shop;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder {

    public function run() {
        $faker = Factory::create();
        $category = 1;

        $gallery = glob(public_path('images/profile_*'));

        for ($i = 0; $i < 60; $i++) {
            if ($category == 6) {
                $category = 1;
            }
            $product = Product::query()->create(array(
                'name'        => $faker->sentence($nbWords = 4, $variableNbWords = true),
                'category_id' => $category++,
                'is_popular'  => $category == 5 ? true : false,
                'price'       => $price = rand(20, 35) * 10,
                'details'     => $faker->text($maxNbChars = 40),
            ));

            $product->addMedia(public_path('images/profile_' . rand(1, 6) . '.jpg'))
                ->usingFileName(Str::random(20))
                ->preservingOriginal()
                ->toMediaCollection('feature');
            //
        }
    }
}
