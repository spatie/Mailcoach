<?php

use Faker\Generator;
use Spatie\Mailcoach\Models\Campaign;
use Spatie\Mailcoach\Models\CampaignSend;
use Spatie\Mailcoach\Models\Subscription;

$factory->define(CampaignSend::class, function (Generator $faker) {
    return [
        'email_campaign_id' => factory(Campaign::class),
        'email_list_subscription_id' => factory(Subscription::class),
    ];
});
