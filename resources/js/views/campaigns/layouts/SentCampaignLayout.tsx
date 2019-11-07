import React from 'react';
import Layout from 'views/layouts/Layout';
import Tab from 'components/Tab';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';

type Props = {
    children: React.ReactNode;
    title: string;
    activeTab: 'summary' | 'opens' | 'clicks' | 'unsubscribes' | 'actions';
    campaign: App.CampaignResource;
};

export default function SentCampaignLayout({ campaign, children, title, activeTab }: Props) {
    const { links } = usePage();

    return (
        <Layout title={title}>
            <main className="layout-main">
                <section className="card card-grid">
                    <nav className="breadcrumbs">
                        <ul>
                            <li>
                                <InertiaLink href={links.campaigns.index}>Campaigns</InertiaLink>
                            </li>
                            <li>
                                {campaign.name} {title}
                            </li>
                        </ul>
                    </nav>

                    <nav>
                        <ul className="tabs">
                            <Tab href={campaign.links.summary} name="summary" activeName={activeTab}>
                                Summary
                            </Tab>
                            <Tab href={campaign.links.clicks} name="clicks" activeName={activeTab}>
                                Clicks ({campaign.click_count})
                            </Tab>
                            <Tab href={campaign.links.opens} name="opens" activeName={activeTab}>
                                Opens ({campaign.open_count})
                            </Tab>
                            <Tab href={campaign.links.unsubscribes} name="unsubscribes" activeName={activeTab}>
                                Unsubscribes ({campaign.unsubscribe_count})
                            </Tab>
                            <Tab href={campaign.links.actions} name="actions" activeName={activeTab}>
                                Actions
                            </Tab>
                        </ul>
                    </nav>
                    {children}
                </section>
            </main>
        </Layout>
    );
}
