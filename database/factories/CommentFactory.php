<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    $posts = App\Post::all()->pluck('id');

    return [
        'author' => $faker->firstName . ' ' . $faker->lastName,
        'content' => $faker->paragraph,
        'created_at' => $faker->dateTime,
        'post_id' => $faker->randomElement($posts)
    ];
});
