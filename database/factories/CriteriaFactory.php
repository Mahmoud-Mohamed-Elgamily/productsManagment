<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Criteria;
use Faker\Generator as Faker;

$factory->define(Criteria::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'type' => $faker->randomElement(['normal', 'nested', 'options', 'color']),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
