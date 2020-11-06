<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\adminPost;
use Faker\Generator as Faker;

$factory->define(adminPost::class, function (Faker $faker) {
    return [
        //
        'post_title' => $faker->words(15, true),
        'post_content' => $faker->realText(2000),
        'status' => 'chờ duyệt',
        'post_thumb' => 'buixuankhai',
        'category' => 'mới nhất',
        'date_create' => now(),
        'user_id' => 1,
    ];
});
