<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3,true),
        'code' => $faker->unique()->postcode,
        'price' => $faker->randomFloat(2, 1, 100000),
        'category_id' => Category::inRandomOrder()->first()->id
    ];
});
