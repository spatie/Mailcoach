<?php

use Spatie\Mailcoach\Mails\CampaignSentMail;
use Spatie\Mailcoach\Mails\CampaignSummaryMail;
use Spatie\Mailcoach\Mails\ConfirmSubscriberMail;
use Spatie\Mailcoach\Mails\EmailListSummaryMail;
use Spatie\Mailcoach\Mails\ImportSubscribersResultMail;
use Spatie\Mailcoach\Models\Campaign;
use Spatie\Mailcoach\Models\EmailList;
use Spatie\Mailcoach\Models\Subscriber;
use Spatie\Mailcoach\Models\SubscriberImport;

Route::get('campaign-sent', function () {
    $campaign = Campaign::factory()->create([
        'sent_to_number_of_subscribers' => 1234,
    ]);

    return new CampaignSentMail($campaign);
});

Route::get('campaign-summary', function () {
    $campaign = Campaign::factory()->create([
        'sent_to_number_of_subscribers' => 1234,
        'sent_at' => now(),
        'track_opens' => true,
        'track_clicks' => true,
    ]);

    return new CampaignSummaryMail($campaign);
});

Route::get('confirm-subscriber', function () {
    $subscriber = Subscriber::factory()->create();

    return new ConfirmSubscriberMail($subscriber);
});

Route::get('email-list-summary', function () {
    $emailList = EmailList::factory()->create();

    return new EmailListSummaryMail($emailList, now());
});

Route::get('import-subscribers-result', function () {
    $subscriberImport = SubscriberImport::factory()->create();

    return new ImportSubscribersResultMail($subscriberImport);
});
