import React from 'react';
import Layout from 'views/layouts/Layout';
import Tab from 'components/Tab';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';

type Props = {
    children: React.ReactNode;
    title: string;
    activeTab: 'settings' | 'subscribers' | 'subscriptionFlow';
    emailList: App.EmailListResource;
};

export default function EmailListLayout({ emailList, children, title, activeTab }: Props) {
    const { links } = usePage();

    return (
        <Layout title={title}>
            <main className="layout-main">
                <section className="card card-grid">
                    <nav className="breadcrumbs">
                        <ul>
                            <li>
                                <InertiaLink href={links.email_lists.index}>Email lists</InertiaLink>
                            </li>
                            <li>{title}</li>
                        </ul>
                    </nav>

                    <nav>
                        <ul className="tabs">
                            <Tab href={emailList.links.settings} name="settings" activeName={activeTab}>
                                Settings
                            </Tab>
                            <Tab href={emailList.links.subscribers} name="subscribers" activeName={activeTab}>
                                Subscribers ({emailList.active_subscription_count})
                            </Tab>
                            <Tab
                                href={emailList.links.subscription_flow}
                                name="subscriptionFlow"
                                activeName={activeTab}
                            >
                                Subscription flow
                            </Tab>
                        </ul>
                    </nav>
                    {children}
                </section>
            </main>
        </Layout>
    );
}
