import React from 'react';
import Layout from 'views/layouts/Layout';
import { InertiaLink } from '@inertiajs/inertia-react';
import { useForm } from '../../forms';
import UserFormFields from './partials/UserFormFields';
import { confirm } from '../../util/index';
import { Inertia } from '@inertiajs/inertia';

type Props = Inertia.PageProps & {
    user: App.UserResource;
};

export default function Create({ user, links }: Props) {
    const form = useForm(user, user.links.edit, 'PUT');

    async function handleDelete() {
        confirm({
            action: 'Delete',
            buttonClassName: 'button-delete',
            text: `Are you sure you want to user ${user.email}? `,
            onConfirm: () => Inertia.delete(user.links.delete),
        });
    }

    return (
        <Layout title="Update user">
            <main className="layout-main">
                <section className="card card-grid">
                    <nav className="breadcrumbs">
                        <ul>
                            <li>
                                <InertiaLink href={links.users.index}>Users</InertiaLink>
                            </li>
                            <li>Update {user.email}</li>
                        </ul>
                    </nav>

                    <form className="card-grid" onSubmit={form.submit}>
                        <UserFormFields form={form} />

                        <div className="buttons">
                            <button type="submit" className="button">
                                Save
                            </button>

                            {!user.is_me && (
                                <button type="button" className="link-delete" onClick={handleDelete}>
                                    Delete
                                </button>
                            )}
                        </div>
                    </form>
                </section>
            </main>
        </Layout>
    );
}
