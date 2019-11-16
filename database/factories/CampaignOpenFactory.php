<?php

namespace Spatie\Mailcoach\Tests\database\factories;

use Faker\Generator;
use Spatie\Mailcoach\Models\Campaign;
use Spatie\Mailcoach\Models\CampaignOpen;
use Spatie\Mailcoach\Models\CampaignSend;
use Spatie\Mailcoach\Models\Subscriber;

$factory->define(CampaignOpen::class, function (Generator $faker) {
    return [
        'campaign_send_id' => factory(CampaignSend::class),
        'email_campaign_id' => factory(Campaign::class),
        'email_list_subscriber_id' => factory(Subscriber::class),
    ];
});
