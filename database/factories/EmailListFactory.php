<?php

use Faker\Generator;

$factory->define(\Spatie\Mailcoach\Models\EmailList::class, function (Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});
