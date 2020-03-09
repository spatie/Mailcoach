<?php

use Faker\Generator;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Tag::class, function (Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});
