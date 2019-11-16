<?php

use Faker\Generator;
use Illuminate\Support\Str;
use Spatie\Mailcoach\Enums\CampaignStatus;
use Spatie\Mailcoach\Models\Campaign;
use Spatie\Mailcoach\Models\EmailList;

$factory->define(Campaign::class, function (Generator $faker) {
    return [
        'name' => $faker->word,
        'subject' => $faker->sentence,
        'from_email' => $faker->email,
        'from_name' => $faker->name,
        'html' => $faker->randomHtml(),
        'track_opens' => $faker->boolean,
        'track_clicks' => $faker->boolean,
        'status' => CampaignStatus::DRAFT,
        'uuid' => $faker->uuid,
        'email_list_id' => function () {
            return factory(EmailList::class)->create(['uuid' => (string)Str::uuid()]);
        }
    ];
});
