<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Recipies\Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->word()
    ];
});
