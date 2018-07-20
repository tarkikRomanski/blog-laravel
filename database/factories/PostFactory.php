<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(rand(2, 5)),
        'content' => $faker->text,
        'file' => $faker->imageUrl($width = 200, $height = 200)
    ];
});
