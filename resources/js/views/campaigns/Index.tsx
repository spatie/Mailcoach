import React, { useState } from 'react';
import Layout from '../layouts/Layout';
import Paginator from 'components/Paginator';
import { InertiaLink } from '@inertiajs/inertia-react';
import { format, parseISO } from 'date-fns';
import { Inertia } from '@inertiajs/inertia';
import { pluralize } from '../../util/index';
import useFetcher from '../../hooks/useFetcher';
import Modal from 'components/Modal';
import { TextField, useForm } from 'forms';
import SortToggle from 'components/SortToggle';
import SelectField from 'forms/components/SelectField';

type Props = Inertia.PageProps & {
    draft_campaigns: App.ResourceCollection<App.CampaignResource>;
    scheduled_campaigns: App.ResourceCollection<App.CampaignResource>;
    campaigns: App.ResourceCollection<App.CampaignResource>;
    template_options: App.Options;
    total_campaigns_count: number;
};

export default function Index({
    draft_campaigns,
    scheduled_campaigns,
    campaigns,
    template_options,
    total_campaigns_count,
    links,
}: Props) {
    const [query, fetchCampaigns] = useFetcher({
        key: 'campaigns',
        url: links.campaigns.index,
        defaultSort: 'name',
    });

    const [showingCampaignModal, setShowingCampaignModal] = useState(false);
    const form = useForm({ name: '', template_id: '' }, links.campaigns.store, 'POST');

    return (
        <Layout title="Campaigns">
            <main className="layout-main">
                <section className="card card-grid">
                    <h1 className="markup-h1">Campaigns</h1>

                    <div className="flex justify-between">
                        <button className="button" onClick={() => setShowingCampaignModal(true)}>
                            Create a new campaign
                        </button>
                        {showingCampaignModal && (
                            <Modal title="Create new campaign" onDismiss={() => setShowingCampaignModal(false)}>
                                <form className="card-grid" onSubmit={form.submit}>
                                    <TextField label="Name" {...form.getInputProps('name')} />

                                    {template_options.length > 0 && (
                                        <>
                                            <SelectField
                                                label="Template"
                                                {...form.getInputProps('template_id')}
                                                options={template_options}
                                            />
                                            <div className="buttons">
                                                <button type="submit" className="button">
                                                    Create new campaign
                                                </button>
                                            </div>
                                        </>
                                    )}
                                </form>
                            </Modal>
                        )}
                        <input
                            type="text"
                            className="form-input w-64 rounded-full"
                            placeholder="Filter campaigns…"
                            defaultValue={query.search}
                            onChange={e => fetchCampaigns({ search: e.target.value })}
                        />
                    </div>

                    {draft_campaigns.data.length > 0 && (
                        <table className="table">
                            <thead>
                                <tr>
                                    <th className="w-4"></th>
                                    <th>Draft</th>
                                    <th className="th-numeric">Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                {draft_campaigns.data.map(campaign => (
                                    <tr
                                        className="tr-clickable"
                                        key={campaign.id}
                                        onClick={() => Inertia.visit(campaign.links.settings)}
                                    >
                                        <td>
                                            <CampaignStatusIcon status={campaign.status} />
                                        </td>
                                        <td>{campaign.name}</td>
                                        <td className="td-numeric">
                                            {format(parseISO(campaign.created_at), 'yyyy-MM-dd')}
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    )}

                    {scheduled_campaigns.data.length > 0 && (
                        <table className="table">
                            <thead>
                                <tr>
                                    <th className="w-4"></th>
                                    <th>Scheduled</th>
                                    <th className="th-numeric">Send at</th>
                                </tr>
                            </thead>
                            <tbody>
                                {scheduled_campaigns.data.map(campaign => (
                                    <tr
                                        className="tr-clickable"
                                        key={campaign.id}
                                        onClick={() => Inertia.visit(campaign.links.delivery)}
                                    >
                                        <td>
                                            <CampaignStatusIcon status={'scheduled'} />
                                        </td>
                                        <td>{campaign.name}</td>
                                        <td className="td-numeric">
                                            {format(parseISO(campaign.scheduled_at), 'yyyy-MM-dd hh:mm:ss')}
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    )}

                    {campaigns.data.length > 0 && (
                        <>
                            <table className="table">
                                <thead>
                                    <tr>
                                        <th className="w-4"></th>
                                        <th>Campaign</th>
                                        <th className="th-numeric">
                                            <SortToggle
                                                name="sent_to_number_of_subscribers"
                                                value={query.sort}
                                                onChange={sort => fetchCampaigns({ sort })}
                                            >
                                                Subscribers
                                            </SortToggle>
                                        </th>
                                        <th className="th-numeric">
                                            <SortToggle
                                                name="open_rate"
                                                value={query.sort}
                                                onChange={sort => fetchCampaigns({ sort })}
                                            >
                                                Open rate
                                            </SortToggle>
                                        </th>
                                        <th className="th-numeric">
                                            <SortToggle
                                                name="click_rate"
                                                value={query.sort}
                                                onChange={sort => fetchCampaigns({ sort })}
                                            >
                                                Click rate
                                            </SortToggle>
                                        </th>
                                        <th className="th-numeric">
                                            <SortToggle
                                                name="unsubscribe_rate"
                                                value={query.sort}
                                                onChange={sort => fetchCampaigns({ sort })}
                                            >
                                                Unsubscribe rate
                                            </SortToggle>{' '}
                                        </th>
                                        <th className="th-numeric">Sent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {campaigns.data
                                        .filter(campaign => campaign.status !== 'created')
                                        .map(campaign => (
                                            <tr
                                                className="tr-clickable"
                                                key={campaign.id}
                                                onClick={() => Inertia.visit(campaign.links.summary)}
                                            >
                                                <td>
                                                    <CampaignStatusIcon status={campaign.status} />
                                                </td>
                                                <td>{campaign.name}</td>
                                                <td className="td-numeric">{campaign.sent_to_number_of_subscribers}</td>
                                                <td className="td-numeric">{campaign.open_rate}</td>
                                                <td className="td-numeric">{campaign.click_rate}</td>
                                                <td className="td-numeric">{campaign.unsubscribe_rate}</td>
                                                <td className="td-numeric">
                                                    {parseISO(campaign.created_at) > new Date() && (
                                                        <span className="mr-1 px-2 py-1 bg-yellow-100 text-xs text-yellow-500 rounded">
                                                            scheduled
                                                        </span>
                                                    )}
                                                    {format(parseISO(campaign.created_at), 'yyyy-MM-dd')}
                                                </td>
                                            </tr>
                                        ))}
                                </tbody>
                            </table>

                            <p className="table-status">
                                {campaigns.meta.total !== total_campaigns_count ? (
                                    <>
                                        Displaying {campaigns.meta.total} of {total_campaigns_count}{' '}
                                        {pluralize('campaign', total_campaigns_count)}.{' '}
                                        <InertiaLink className="link" href={links.campaigns.index}>
                                            Show all
                                        </InertiaLink>
                                    </>
                                ) : (
                                    <>
                                        Displaying all {total_campaigns_count}{' '}
                                        {pluralize('campaign', total_campaigns_count)}.
                                    </>
                                )}
                            </p>

                            <Paginator
                                currentPage={campaigns.meta.current_page}
                                lastPage={campaigns.meta.last_page}
                                onChange={page => fetchCampaigns({ page })}
                            />
                        </>
                    )}
                </section>
            </main>
        </Layout>
    );
}

function CampaignStatusIcon({ status, className = '' }: { status: string; className?: string }) {
    switch (status) {
        case 'draft':
            return <i title="Draft" className={`far fa-edit text-gray-500 ${className}`} />;
        case 'sent':
            return <i title="Sent" className={`fas fa-check text-green-500 ${className}`} />;
        case 'sending':
            return <i title="Sending" className={`fas fa-sync fa-spin text-blue-500 ${className}`} />;
        case 'scheduled':
            return <i title="Scheduled" className={`far fa-clock text-yellow-500 ${className}`} />;
        default:
            return null;
    }
}
