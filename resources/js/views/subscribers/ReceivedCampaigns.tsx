import React from 'react';
import SubscriberLayout from 'views/subscribers/layouts/SubscriberLayout';
import { InertiaLink } from '@inertiajs/inertia-react';
import SortToggle from 'components/SortToggle';
import { Inertia } from '@inertiajs/inertia';
import { format, parseISO } from 'date-fns';
import { pluralize } from '../../util/index';
import Paginator from 'components/Paginator';
import useFetcher from 'hooks/useFetcher';

type Props = Inertia.PageProps & {
    subscriber: App.SubscriberResource;
    campaign_sends: App.ResourceCollection<App.CampaignSendResource>;
    total_campaign_sends_count: number;
};

export default function ReceivedCampaigns({ subscriber, campaign_sends, total_campaign_sends_count }: Props) {
    const [query, fetchCampaignSends] = useFetcher({
        key: 'campaign_sends',
        url: subscriber.links.received_campaigns,
        defaultSort: '-sent_at',
    });

    return (
        <SubscriberLayout title="Received campaigns" activeTab="received_campaigns" subscriber={subscriber}>
            <div className="flex justify-between">
                <input
                    type="text"
                    className="form-input w-64 rounded-full"
                    placeholder="Filter received campaigns…"
                    defaultValue={query.search}
                    onChange={e => fetchCampaignSends({ search: e.target.value })}
                />
            </div>

            <table className="table">
                <thead>
                    <tr>
                        <th>
                            <SortToggle
                                className="th-numeric"
                                name="campaign_name"
                                value={query.sort}
                                onChange={sort => fetchCampaignSends({ sort })}
                            >
                                Campaign name
                            </SortToggle>
                        </th>
                        <th className="th-numeric">Opens</th>
                        <th className="th-numeric">Clicks</th>
                        <th className="th-numeric">
                            <SortToggle
                                name="sent_at"
                                value={query.sort}
                                onChange={sort => fetchCampaignSends({ sort })}
                            >
                                Sent at
                            </SortToggle>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {campaign_sends.data.map(campaign_send => (
                        <tr
                            key={campaign_send.id}
                            className="tr-clickable"
                            onClick={() => Inertia.visit(campaign_send.campaign.links.summary)}
                        >
                            <td>{campaign_send.campaign.name}</td>
                            <td className="td-numeric">{campaign_send.opens}</td>
                            <td className="td-numeric">{campaign_send.clicks}</td>
                            <td className="td-numeric">
                                {campaign_send.sent_at ? format(parseISO(campaign_send.sent_at), 'yyyy-MM-dd') : ''}
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>

            <p className="table-status">
                {campaign_sends.meta.total !== total_campaign_sends_count ? (
                    <>
                        Displaying {campaign_sends.meta.total} of {total_campaign_sends_count}{' '}
                        {pluralize('received campaigns', total_campaign_sends_count)}.{' '}
                        <InertiaLink href={subscriber.links.received_campaigns} className="underline">
                            Show all
                        </InertiaLink>
                    </>
                ) : (
                    <>
                        {total_campaign_sends_count > 0 && (
                            <>
                                Displaying all {total_campaign_sends_count}{' '}
                                {pluralize('received campaign', total_campaign_sends_count)}.
                            </>
                        )}
                        {total_campaign_sends_count === 0 && <>No campaigns have been sent to this subscriber yet.</>}
                    </>
                )}
            </p>

            <Paginator
                currentPage={campaign_sends.meta.current_page}
                lastPage={campaign_sends.meta.last_page}
                onChange={page => fetchCampaignSends({ page })}
            />
        </SubscriberLayout>
    );
}
