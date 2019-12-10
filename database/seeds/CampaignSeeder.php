<?php

use Illuminate\Database\Seeder;
use Spatie\Mailcoach\Enums\CampaignStatus;
use Spatie\Mailcoach\Jobs\CalculateStatisticsJob;
use Spatie\Mailcoach\Models\Campaign;
use Spatie\Mailcoach\Models\CampaignLink;
use Spatie\Mailcoach\Models\Send;
use Spatie\Mailcoach\Models\EmailList;
use Spatie\Mailcoach\Models\Subscriber;

class CampaignSeeder extends Seeder
{
    public function run()
    {
        factory(Campaign::class, 1)->create([
            'status' => CampaignStatus::DRAFT,
            'scheduled_at' => null,
            'email_list_id' => EmailList::all()->random()->id,
        ]);

        factory(Campaign::class, 1)->create([
            'status' => CampaignStatus::DRAFT,
            'scheduled_at' => faker()->dateTimeBetween('+1 day', '+1 year'),
            'email_list_id' => EmailList::all()->random()->id,
        ]);

        factory(Campaign::class, 1)->create([
            'status' => CampaignStatus::SENDING,
            'email_list_id' => EmailList::all()->random()->id,
        ]);

        factory(Campaign::class, 5)->create([
            'status' => CampaignStatus::SENT,
            'track_opens' => true,
            'track_clicks' => true,
            'sent_at' => faker()->dateTimeBetween('-1 month', 'now'),
            'email_list_id' => EmailList::all()->random()->id,
        ])->each(function (Campaign $campaign) {
            foreach (range(1, faker()->numberBetween(1, 10)) as $i) {
                factory(CampaignLink::class, 10)->create([
                    'campaign_id' => $campaign->id,
                ]);
            }

            $campaign->emailList
                ->subscribers
                ->each(function (Subscriber $subscriber) use ($campaign) {
                    /** @var Send $send */
                    $send = factory(Send::class)->create([
                        'subscriber_id' => $subscriber->id,
                        'campaign_id' => $campaign->id,
                        'sent_at' => $campaign->sent_at,
                    ]);

                    $linkUrl = faker()->url;

                    if (faker()->boolean(70)) {
                        $open = $send->registerOpen();

                        if ($open) {
                            $open->created_at = faker()->dateTimeBetween($campaign->sent_at, $campaign->sent_at->addHours(16));
                            $open->save();
                        }

                        if (faker()->boolean(50)) {
                            $campaignClick = $send->registerClick($linkUrl);

                            if ($campaignClick) {
                                $campaignClick->created_at = faker()->dateTimeBetween($campaign->sent_at, $campaign->sent_at->addHours(16));
                                $campaignClick->save();
                            }
                        }
                    }

                    if (faker()->boolean(2)) {
                        $campaign->emailList->unsubscribe($subscriber->email);
                    }

                    if (faker()->boolean(2)) {
                        $send->registerBounce();
                    }

                    if (faker()->boolean(2)) {
                        $send->registerComplaint();
                    }
                });

            (new CalculateStatisticsJob($campaign))->handle();
        });
    }
}
