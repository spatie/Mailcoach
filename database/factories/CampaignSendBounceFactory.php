<?php

use Faker\Generator;
use Spatie\Mailcoach\Models\CampaignSend;
use Spatie\Mailcoach\Models\CampaignSendBounce;

$factory->define(CampaignSendBounce::class, function (Generator $faker) {
    return [
        'campaign_send_id' => factory(CampaignSend::class),
        'severity' => 'permanent',
    ];
});
