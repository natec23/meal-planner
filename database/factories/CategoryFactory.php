<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Grocery\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'is_food' => $faker->boolean()
    ];
});
