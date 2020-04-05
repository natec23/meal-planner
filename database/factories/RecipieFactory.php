<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Recipies\Recipie::class, function (Faker $faker) {
    return [
        'name' => $faker->text(100),
        'notes' => $faker->paragraph,
        'public_flag' => $faker->boolean,
        'prep_time' => $faker->numberBetween(0, 45),
        'cook_time' => $faker->numberBetween(5, 90),
        'oven_temp' => ($faker->boolean(50) ? $faker->numberBetween(200, 475) : NULL),
        'yield' => $faker->numberBetween(3, 10),
        'yield_unit' => $faker->randomElement(['servings', 'cups', 'oz']),
        'origin' => ($faker->boolean() ? ($faker->boolean() ? $faker->url() : $faker->name()) : NULL),
        'author_id' => function() {
            return factory(App\User::class)->create()->id;
        },
    ];
});
