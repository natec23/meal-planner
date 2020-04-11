<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Recipies\RecipieDirection::class, function (Faker $faker) {
    return [
        'recipie_id' => function() {
            return factory(App\Recipie::class)->create()->id;
        },
        'heading' => ($faker->boolean(50) ? $faker->sentence(5) : NULL),
        'details' => $faker->paragraph(),
        'sort' => $faker->randomDigit()
    ];
});
