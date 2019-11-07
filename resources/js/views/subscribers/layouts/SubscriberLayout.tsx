import React from 'react';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import Tab from 'components/Tab';
import Layout from 'views/layouts/Layout';

type Props = {
    children: React.ReactNode;
    title: string;
    activeTab: 'details' | 'received_campaigns';
    subscriber: App.SubscriberResource;
};

export default function SubscriberLayout({ subscriber, children, title, activeTab }: Props) {
    const { links } = usePage();

    return (
        <Layout title={title}>
            <main className="layout-main">
                <section className="card card-grid">
                    <nav className="breadcrumbs">
                        <ul>
                            <li>
                                <InertiaLink href={links.subscribers.index}>Subscribers</InertiaLink>
                            </li>
                            <li>{title}</li>
                        </ul>
                    </nav>

                    <nav>
                        <ul className="tabs">
                            <Tab href={subscriber.links.edit} name="details" activeName={activeTab}>
                                Details
                            </Tab>

                            <Tab
                                href={subscriber.links.received_campaigns}
                                name="received_campaigns"
                                activeName={activeTab}
                            >
                                Received campaigns ({subscriber.total_campaign_sends_count})
                            </Tab>
                        </ul>
                    </nav>
                    {children}
                </section>
            </main>
        </Layout>
    );
}
