import React from 'react';
import { Inertia } from '@inertiajs/inertia';
import { format, parseISO } from 'date-fns';
import { pluralize } from '../../../util';
import LineChart from 'views/campaigns/components/TimelineGraph';
import ProgressBar from 'components/ProgressBar';
import SentCampaignLayout from 'views/campaigns/layouts/SentCampaignLayout';

type Props = Inertia.PageProps & {
    campaign: App.CampaignResource;
    stats: {
        opens: Array<[number, string]>;
        unique_opens: Array<[number, string]>;
        clicks: Array<[number, string]>;
        unique_clicks: Array<[number, string]>;
    };
};

export default function Summary({ campaign, stats }: Props) {
    if (campaign.status !== 'sent' || !campaign.sent_to_all_subscribers) {
        setTimeout(
            () =>
                Inertia.reload({
                    preserveScroll: true,
                    preserveState: true,
                }),
            3000
        );
    }

    let chartData = new Array(0);

    if (campaign.track_opens) {
        chartData.push([stats.opens, 'Opens']);
        chartData.push([stats.unique_opens, 'Unique Opens']);
    }

    if (campaign.track_clicks) {
        chartData.push([stats.clicks, 'Clicks']);
        chartData.push([stats.unique_clicks, 'Unique Clicks']);
    }

    return (
        <SentCampaignLayout title="Summary" activeTab="summary" campaign={campaign}>
            <a href={campaign.links.web_view} target="_blank">
                View web version
            </a>

            {campaign.status !== 'sent' || !campaign.sent_to_all_subscribers ? (
                <div>
                    {campaign.sent_to_number_of_subscribers ? (
                        <>
                            <ProgressBar
                                value={(campaign.sends_count / campaign.sent_to_number_of_subscribers) * 100}
                            />
                            <p className="mt-4">
                                <i className="fas fa-sync fa-spin text-blue-500 mr-2" />
                                Sending to <strong>{campaign.sends_count}</strong>/
                                {campaign.sent_to_number_of_subscribers}{' '}
                                {pluralize('subscriber', campaign.sent_to_number_of_subscribers)} of{' '}
                                <strong>{campaign.list.name}</strong>
                            </p>
                        </>
                    ) : (
                        <>
                            <p className="mt-4">
                                <i className="fas fa-sync fa-spin text-blue-500 mr-2" />
                                Preparing to send to <strong>{campaign.list.name}</strong>
                            </p>
                        </>
                    )}
                </div>
            ) : (
                <p>
                    <i className="fas fa-check text-green-500 mr-2" />
                    Sent to <strong>{campaign.sent_to_number_of_subscribers}</strong>{' '}
                    {pluralize('subscriber', campaign.sent_to_number_of_subscribers)} of{' '}
                    <strong>{campaign.list.name}</strong> on{' '}
                    <strong>{format(parseISO(campaign.sent_at || campaign.created_at), 'yyyy-MM-dd HH:mm')}</strong>
                </p>
            )}

            <div className="">
                <LineChart data={chartData} />
            </div>
            <div className="mt-8 grid cols-3 gap-6 justify-start max-w-xl">
                <Statistic stat={campaign.unsubscribe_count} label={`Unsubscribes`} />
                <Statistic stat={campaign.unsubscribe_rate} label={`Unsubscribe Rate`} suffix="%" />

                <div className="start-1 span-3 grid cols-3 gap-6">
                    <Statistic stat={campaign.bounce_count} label={`Bounces`} />
                    <Statistic stat={campaign.bounce_rate} label={`Bounce Rate`} suffix="%" />
                </div>

                {campaign.track_opens ? (
                    <>
                        <Statistic className="start-1" stat={campaign.open_count} label={`Opens`} />
                        <Statistic stat={campaign.unique_open_count} label={`Unique Opens`} />
                        <Statistic stat={campaign.open_rate} label={`Open Rate`} suffix="%" />
                    </>
                ) : (
                    <div className="start-1 span-3">
                        <div className="text-2xl font-bold">–</div>
                        <div className="text-sm">Opens not tracked</div>
                    </div>
                )}
                {campaign.track_clicks ? (
                    <>
                        <Statistic className="start-1" stat={campaign.click_count} label={`Clicks`} />
                        <Statistic stat={campaign.unique_click_count} label={`Unique Clicks`} />
                        <Statistic stat={campaign.click_rate} label={`Click Rate`} suffix="%" />
                    </>
                ) : (
                    <div className="start-1 span-3">
                        <div className="text-2xl font-bold">–</div>
                        <div className="text-sm">Clicks not tracked</div>
                    </div>
                )}
            </div>
        </SentCampaignLayout>
    );
}

function Statistic({
    stat,
    label,
    prefix,
    suffix,
    className,
}: {
    stat: number;
    label: string;
    prefix?: string;
    suffix?: string;
    className?: string;
}) {
    return (
        <div className={className}>
            <div className="text-2xl font-bold">
                {prefix}
                {stat}
                <span className="font-normal text-sm">{suffix}</span>
            </div>
            <div className="text-sm">{label}</div>
        </div>
    );
}
