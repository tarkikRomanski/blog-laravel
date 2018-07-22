<?php

use Faker\Generator as Faker;

$files = [
    'QDzY3fNd0kwK9jtw0gKye7k81i55xW0BNAjvzcie.pdf',
    'j1g6CWWgJn2lyUE8qPNB7gbAvZg4620sI8KxahWb.jpeg'
];

$factory->define(App\Post::class, function (Faker $faker) use ($files) {
    $file = $faker->randomElement($files);
    $file_type = \App\Classes\Facades\Uploader::getFileType($file);
    return [
        'name' => $faker->sentence(rand(2, 5)),
        'content' => $faker->text,
        'file' => $file,
        'file_type' => $file_type
    ];
});
