<?php

use Faker\Generator as Faker;

$factory->define(App\Color::class, function (Faker $faker) {
    return [
        'name' => $faker->colorName,
        'code' => $faker->hexcolor,
    ];
});
