<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Grocery\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'category_id' => function() {
            return factory(App\Models\Grocery\Category::class)->create()->id;
        },
        'name' => $faker->word()
    ];
});
