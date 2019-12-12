<?php

use Faker\Generator;
use Spatie\Mailcoach\Enums\SubscriberImportStatus;
use Spatie\Mailcoach\Models\EmailList;
use Spatie\Mailcoach\Models\SubscriberImport;

$factory->define(SubscriberImport::class, function (Generator $faker) {
    return [
        'status' => SubscriberImportStatus::COMPLETED,
        'email_list_id' => factory(EmailList::class),
        'imported_subscribers_count' => $faker->numberBetween(1, 1000),
        'error_count' => $faker->numberBetween(1, 5),
    ];
});
