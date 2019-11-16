<?php

use Faker\Generator;
use Spatie\Mailcoach\Enums\SubscriptionStatus;
use Spatie\Mailcoach\Models\EmailList;
use Spatie\Mailcoach\Models\Subscriber;
use Spatie\Mailcoach\Models\Subscription;

$factory->define(Subscription::class, function (Generator $faker) {
    return [
        'email_list_id' => factory(EmailList::class),
        'email_list_subscriber_id' => factory(Subscriber::class),
        'status' => SubscriptionStatus::SUBSCRIBED,
    ];
});
