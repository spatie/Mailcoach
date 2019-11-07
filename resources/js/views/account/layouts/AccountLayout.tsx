import React from 'react';
import Layout from 'views/layouts/Layout';
import { usePage } from '@inertiajs/inertia-react';
import Tab from 'components/Tab';

type Props = {
    children: React.ReactNode;
    title: string;
    activeTab: 'account' | 'password';
};

export default function AccountLayout({ children, title, activeTab }: Props) {
    const { links } = usePage();

    return (
        <Layout title={title}>
            <main className="layout-main">
                <section className="card card-grid">
                    <nav>
                        <ul className="tabs">
                            <Tab href={links.account.index} name="account" activeName={activeTab}>
                                Account
                            </Tab>
                            <Tab href={links.account.password} name="password" activeName={activeTab}>
                                Password
                            </Tab>
                        </ul>
                    </nav>
                    {children}
                </section>
            </main>
        </Layout>
    );
}
