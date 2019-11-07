import React from 'react';
import SentCampaignLayout from 'views/campaigns/layouts/SentCampaignLayout';
import SortToggle from 'components/SortToggle';
import { Inertia } from '@inertiajs/inertia';
import { format, parseISO } from 'date-fns';
import { pluralize } from '../../../util/index';
import { InertiaLink } from '@inertiajs/inertia-react';
import Paginator from 'components/Paginator';
import useFetcher from 'hooks/useFetcher';

type Props = Inertia.PageProps & {
    campaign: App.CampaignResource;
    campaign_unsubscribes: App.ResourceCollection<App.CampaignUnsubscribeResource>;
    total_campaign_unsubscribes: number;
};

export default function Unsubscribes({ campaign, campaign_unsubscribes, total_campaign_unsubscribes }: Props) {
    const [query, fetchCampaignUnsubscribes] = useFetcher({
        key: 'campaign_unsubscribes',
        url: campaign.links.unsubscribes,
        defaultSort: '-created_at',
    });

    return (
        <SentCampaignLayout campaign={campaign} title="Unsubscribes" activeTab="unsubscribes">
            <div className="flex justify-between">
                <input
                    type="text"
                    className="form-input w-64 rounded-full"
                    placeholder="Filter unsubscribes…"
                    defaultValue={query.search}
                    onChange={e => fetchCampaignUnsubscribes({ search: e.target.value })}
                />
            </div>

            <table className="table">
                <thead>
                    <tr>
                        <th>
                            <SortToggle
                                name="email"
                                value={query.sort}
                                onChange={sort => fetchCampaignUnsubscribes({ sort })}
                            >
                                Email
                            </SortToggle>
                        </th>
                        <th>
                            <SortToggle
                                name="first_name"
                                value={query.sort}
                                onChange={sort => fetchCampaignUnsubscribes({ sort })}
                            >
                                First name
                            </SortToggle>
                        </th>
                        <th>
                            <SortToggle
                                name="last_name"
                                value={query.sort}
                                onChange={sort => fetchCampaignUnsubscribes({ sort })}
                            >
                                Last name
                            </SortToggle>
                        </th>
                        <th className="th-numeric">
                            <SortToggle
                                name="created_at"
                                value={query.sort}
                                onChange={sort => fetchCampaignUnsubscribes({ sort })}
                            >
                                Unsubscribed at
                            </SortToggle>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {campaign_unsubscribes.data.map(campaign_unsubscribe => (
                        <tr
                            key={campaign_unsubscribe.id}
                            className="tr-clickable"
                            onClick={() => Inertia.visit(campaign_unsubscribe.subscriber.links.edit)}
                        >
                            <td>{campaign_unsubscribe.subscriber.email}</td>
                            <td>{campaign_unsubscribe.subscriber.first_name}</td>
                            <td>{campaign_unsubscribe.subscriber.last_name}</td>
                            <td className="td-numeric">
                                {format(parseISO(campaign_unsubscribe.unsubscribed_at), 'yyyy-MM-dd')}
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>

            <p className="table-status">
                {campaign_unsubscribes.meta.total !== total_campaign_unsubscribes ? (
                    <>
                        Displaying {campaign_unsubscribes.meta.total} of {total_campaign_unsubscribes}{' '}
                        {pluralize('unsubscribe', total_campaign_unsubscribes)}.{' '}
                        <InertiaLink href={campaign.links.unsubscribes} className="underline">
                            Show all
                        </InertiaLink>
                    </>
                ) : (
                    <>
                        {total_campaign_unsubscribes > 0 && (
                            <>
                                Displaying all {total_campaign_unsubscribes}{' '}
                                {pluralize('unsubscribe', total_campaign_unsubscribes)}.
                            </>
                        )}
                        {total_campaign_unsubscribes === 0 && <>Nobody has unsubscribed the campaign yet.</>}
                    </>
                )}
            </p>

            <Paginator
                currentPage={campaign_unsubscribes.meta.current_page}
                lastPage={campaign_unsubscribes.meta.last_page}
                onChange={page => fetchCampaignUnsubscribes({ page })}
            />
        </SentCampaignLayout>
    );
}
