<?php

use Faker\Generator;

$factory->define(\Spatie\Mailcoach\Models\EmailList::class, function (Generator $faker) {
    return [
        'name' => $faker->word,
        'default_from_email' => $faker->email,
        'default_from_name' => $faker->name,
    ];
});
