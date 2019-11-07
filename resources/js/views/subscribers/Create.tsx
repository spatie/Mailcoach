import React from 'react';
import Layout from 'views/layouts/Layout';
import { InertiaLink } from '@inertiajs/inertia-react';
import { useForm } from '../../forms';
import SubscriberFormFields from './partials/SubscriberFormFields';

type Props = Inertia.PageProps & {
    subscriber: App.SubscriberResource;
    emailListOptions: App.Options;
};

export default function Create({ subscriber, emailListOptions, links }: Props) {
    const form = useForm(subscriber, subscriber.links.store, 'POST');

    return (
        <Layout title="Create subscriber">
            <main className="layout-main">
                <section className="card card-grid">
                    <nav className="breadcrumbs">
                        <ul>
                            <li>
                                <InertiaLink href={links.subscribers.index}>Subscribers</InertiaLink>
                            </li>
                            <li>Create a new subscriber</li>
                        </ul>
                    </nav>

                    <form className="card-grid" onSubmit={form.submit}>
                        <SubscriberFormFields emailListOptions={emailListOptions} form={form} />

                        <div className="buttons">
                            <button type="submit" className="button">
                                Save
                            </button>
                        </div>
                    </form>
                </section>
            </main>
        </Layout>
    );
}
