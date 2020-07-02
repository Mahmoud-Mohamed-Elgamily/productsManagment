<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'description' => $faker->text,
        'vendor' => $faker->word,
        'sale' => $faker->randomDigitNotNull,
        'mainImagePath' => $faker->word,
        'criteria_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
