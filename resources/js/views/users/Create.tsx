import React from 'react';
import Layout from 'views/layouts/Layout';
import { InertiaLink } from '@inertiajs/inertia-react';
import { useForm } from '../../forms';
import UserFormFields from './partials/UserFormFields';

type Props = Inertia.PageProps & {
    user: App.UserResource;
};

export default function Create({ user, links }: Props) {
    const form = useForm(user, user.links.store, 'POST');

    return (
        <Layout title="Create user">
            <main className="layout-main">
                <section className="card card-grid">
                    <nav className="breadcrumbs">
                        <ul>
                            <li>
                                <InertiaLink href={links.users.index}>Users</InertiaLink>
                            </li>
                            <li>Create a new user</li>
                        </ul>
                    </nav>

                    <form className="card-grid" onSubmit={form.submit}>
                        <UserFormFields form={form} />

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
