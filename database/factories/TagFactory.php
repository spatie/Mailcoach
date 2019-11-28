<?php

use Faker\Generator;
use Spatie\Mailcoach\Models\Template;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Tag::class, function (Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});
