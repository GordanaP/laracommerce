<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->sentence(3),
        'description' => $faker->paragraph(2),
        'price' => rand(1000, 100000),
    ];
});
