<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Recipies\RecipieIngredient::class, function (Faker $faker) {
    return [
        'recipie_id' => function() {
            return factory(App\Recipie::class)->create()->id;
        },
        'item_id' => function() {
            return factory(App\Models\Grocery\Item::class)->create()->id;
        },
        'unit' => $faker->randomElement($array = array ('oz','cup','can')),
        'amount' => $faker->randomFloat(1, 0.5, 50),
        'optional' => $faker->boolean(),
        'notes' => ($faker->boolean() ? $faker->sentence() : ''),
        'sort' => $faker->randomDigit()
    ];
});
