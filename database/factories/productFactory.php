<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\adminProduct;
use Faker\Generator as Faker;

$factory->define(adminProduct::class, function (Faker $faker) {
    return [
        'product_name' => $faker->words(3, true), 
        'product_price' => $faker->randomFloat(2, 10, 100), 
        'product_content' => $faker->realText(250),
        'product_configuration' => $faker->realText(250),
        'status'=>'hết hàng',
        'product_thumb'=>'img',
        'category'=>1,
        'date_create'=>now(),
        'user_id' => 43,
    ];
});
