<?php

use Spatie\Mailcoach\Models\Campaign;

Route::get('campaign-sent', function () {
    $campaign = factory(Campaign::class)->create();

    return (new \Spatie\Mailcoach\Mails\CampaignSentMail($campaign))->render();
});
