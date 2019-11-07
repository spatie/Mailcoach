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
    campaign_opens: App.ResourceCollection<App.CampaignOpenResource>;
    total_campaign_opens: number;
};

export default function Opens({ campaign, campaign_opens, total_campaign_opens }: Props) {
    const [query, fetchCampaignOpens] = useFetcher({
        key: 'campaign_opens',
        url: campaign.links.opens,
        defaultSort: '-created_at',
    });

    return (
        <SentCampaignLayout campaign={campaign} title="Opens" activeTab="opens">
            {campaign.track_opens && (
                <>
                    <div className="flex justify-between">
                        <input
                            type="text"
                            className="form-input w-64 rounded-full"
                            placeholder="Filter opens…"
                            defaultValue={query.search}
                            onChange={e => fetchCampaignOpens({ search: e.target.value })}
                        />
                    </div>

                    <table className="table">
                        <thead>
                            <tr>
                                <th>
                                    <SortToggle
                                        name="email"
                                        value={query.sort}
                                        onChange={sort => fetchCampaignOpens({ sort })}
                                    >
                                        Email
                                    </SortToggle>
                                </th>
                                <th>
                                    <SortToggle
                                        name="first_name"
                                        value={query.sort}
                                        onChange={sort => fetchCampaignOpens({ sort })}
                                    >
                                        First name
                                    </SortToggle>
                                </th>
                                <th>
                                    <SortToggle
                                        name="last_name"
                                        value={query.sort}
                                        onChange={sort => fetchCampaignOpens({ sort })}
                                    >
                                        Last name
                                    </SortToggle>
                                </th>
                                <th className="th-numeric">
                                    <SortToggle
                                        name="created_at"
                                        value={query.sort}
                                        onChange={sort => fetchCampaignOpens({ sort })}
                                    >
                                        Opened at
                                    </SortToggle>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {campaign_opens.data.map(campaign_open => (
                                <tr
                                    key={campaign_open.id}
                                    className="tr-clickable"
                                    onClick={() => Inertia.visit(campaign_open.subscriber.links.edit)}
                                >
                                    <td>{campaign_open.subscriber.email}</td>
                                    <td>{campaign_open.subscriber.first_name}</td>
                                    <td>{campaign_open.subscriber.last_name}</td>
                                    <td className="td-numeric">
                                        {format(parseISO(campaign_open.opened_at), 'yyyy-MM-dd')}
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>

                    <p className="table-status">
                        {campaign_opens.meta.total !== total_campaign_opens ? (
                            <>
                                Displaying {campaign_opens.meta.total} of {total_campaign_opens}{' '}
                                {pluralize('subscriber', total_campaign_opens)}.{' '}
                                <InertiaLink href={campaign.links.opens} className="underline">
                                    Show all
                                </InertiaLink>
                            </>
                        ) : (
                            <>
                                {total_campaign_opens > 0 && (
                                    <>
                                        Displaying all {total_campaign_opens} {pluralize('open', total_campaign_opens)}.
                                    </>
                                )}
                                {total_campaign_opens === 0 && <>Nobody has opened the campaign yet.</>}
                            </>
                        )}
                    </p>

                    <Paginator
                        currentPage={campaign_opens.meta.current_page}
                        lastPage={campaign_opens.meta.last_page}
                        onChange={page => fetchCampaignOpens({ page })}
                    />
                </>
            )}

            {!campaign.track_opens && <>Opens are not tracked for this campaign.</>}
        </SentCampaignLayout>
    );
}
