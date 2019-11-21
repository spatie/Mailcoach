<?php

use Faker\Generator;
use Spatie\Mailcoach\Models\EmailList;

$factory->define(\Spatie\Mailcoach\Models\Subscriber::class, function (Generator $faker) {
    return [
        'email' => $faker->email,
        'email_list_id' => factory(EmailList::class),
    ];
});
