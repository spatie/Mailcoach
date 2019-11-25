<?php

namespace Spatie\Mailcoach\Tests\database\factories;

use Faker\Generator;
use Spatie\Mailcoach\Models\Campaign;
use Spatie\Mailcoach\Models\CampaignLink;

$factory->define(CampaignLink::class, function (Generator $faker) {
    return [
        'email_campaign_id' => factory(Campaign::class),
        'link' => $faker->url,
    ];
});
