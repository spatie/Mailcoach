<?php

use Faker\Generator;

$factory->define(\Spatie\Mailcoach\Models\Subscriber::class, function (Generator $faker) {
    return [
        'email' => $faker->email,
    ];
});
