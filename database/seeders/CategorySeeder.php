<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Shop;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder {

    public function run() {
        $categories = ['All', 'Pizza', 'Burger', 'Rice', 'Soup', 'Drinks'];
        for ($i = 0; $i < 6; $i++) {
            Category::query()->create(array(
                'name'    => $categories[$i]
            ));
        }
    }
}
