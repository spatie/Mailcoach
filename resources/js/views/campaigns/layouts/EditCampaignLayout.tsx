import React from 'react';
import Layout from 'views/layouts/Layout';
import Tab from 'components/Tab';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';

type Props = {
    children: React.ReactNode;
    title: string;
    activeTab: 'settings' | 'html' | 'delivery';
    campaign: App.CampaignResource;
};

export default function EditCampaignLayout({ campaign, children, title, activeTab }: Props) {
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
                            <li>{title}</li>
                        </ul>
                    </nav>

                    <nav>
                        <ul className="tabs">
                            <Tab href={campaign.links.settings} name="settings" activeName={activeTab}>
                                Settings
                            </Tab>
                            <Tab href={campaign.links.html} name="html" activeName={activeTab}>
                                HTML
                            </Tab>
                            <Tab href={campaign.links.delivery} name="delivery" activeName={activeTab}>
                                Delivery
                            </Tab>
                        </ul>
                    </nav>
                    {children}
                </section>
            </main>
        </Layout>
    );
}
