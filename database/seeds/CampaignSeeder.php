<?php

use Illuminate\Database\Seeder;
use Spatie\Mailcoach\Enums\CampaignStatus;
use Spatie\Mailcoach\Jobs\CalculateStatisticsJob;
use Spatie\Mailcoach\Models\Campaign;
use Spatie\Mailcoach\Models\CampaignLink;
use Spatie\Mailcoach\Models\CampaignOpen;
use Spatie\Mailcoach\Models\CampaignSend;
use Spatie\Mailcoach\Models\EmailList;
use Spatie\Mailcoach\Models\Subscription;

class CampaignSeeder extends Seeder
{
    public function run()
    {
        factory(Campaign::class, 4)->create([
            'status' => CampaignStatus::DRAFT,
            'scheduled_at' => null,
            'email_list_id' => EmailList::all()->random()->id,
        ]);

        factory(Campaign::class, 4)->create([
            'status' => CampaignStatus::DRAFT,
            'scheduled_at' => faker()->dateTimeBetween('+1 day', '+1 year'),
            'email_list_id' => EmailList::all()->random()->id,
        ]);

        factory(Campaign::class, 2)->create([
            'status' => CampaignStatus::SENDING,
            'email_list_id' => EmailList::all()->random()->id,
        ]);

        factory(Campaign::class, 2)->create([
            'status' => CampaignStatus::SENT,
            'track_opens' => true,
            'track_clicks' => true,
            'sent_at' => faker()->dateTimeBetween('-1 month', 'now'),
            'email_list_id' => EmailList::all()->random()->id,
        ])->each(function (Campaign $campaign) {
            foreach (range(1, faker()->numberBetween(1, 10)) as $i) {
                factory(CampaignLink::class, 10)->create([
                    'email_campaign_id' => $campaign->id,
                ]);
            }

            $campaign->emailList
                ->subscriptions
                ->each(function (Subscription $subscription) use ($campaign) {
                    /** @var CampaignSend $campaignSend */
                    $campaignSend = factory(CampaignSend::class)->create([
                        'email_list_subscription_id' => $subscription->id,
                        'email_campaign_id' => $campaign->id,
                        'sent_at' => $campaign->sent_at,
                    ]);

                    if (faker()->boolean(50)) {
                        factory(CampaignOpen::class)->create([
                            'campaign_send_id' => $campaignSend->id,
                            'email_campaign_id' => $campaign->id,
                            'email_list_subscriber_id' => $subscription->subscriber->id,
                            'created_at' => faker()->dateTimeBetween('-1 week', '+1 week')
                        ]);
                    }

                    $campaign->links->each(function (CampaignLink $campaignLink) use ($campaignSend, $subscription) {
                        if (faker()->boolean(20)) {
                            $campaignLink->registerClick($campaignSend);
                        }

                        if (faker()->boolean(20)) {
                            $campaignLink->registerClick($campaignSend);
                        }
                    });

                    if (faker()->boolean(20)) {
                        $campaign->emailList->unsubscribe($subscription->subscriber->email);
                    }

                    if (faker()->boolean(10)) {
                        $campaignSend->markAsBounced();
                    }

                    if (faker()->boolean(10)) {
                        $campaignSend->complaintReceived();
                    }

                });

            (new CalculateStatisticsJob($campaign))->handle();
        });


    }
}
