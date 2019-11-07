import React from 'react';
import Layout from '../layouts/Layout';
import useFetcher from 'hooks/useFetcher';
import SortToggle from 'components/SortToggle';
import Paginator from 'components/Paginator';
import { pluralize } from '../../util/index';
import { InertiaLink } from '@inertiajs/inertia-react';
import { Inertia } from '@inertiajs/inertia';

type Props = Inertia.PageProps & {
    users: App.ResourceCollection<App.UserResource>;
    total_users_count: number;
};

export default function Index({ users, total_users_count, links }: Props) {
    const [query, fetchUsers] = useFetcher({
        key: 'users',
        url: links.users.index,
        defaultSort: 'email',
    });

    return (
        <Layout title="Users">
            <main className="layout-main">
                <section className="card card-grid">
                    <h1 className="markup-h1">Users</h1>

                    <div className="flex justify-between">
                        <InertiaLink href={links.users.create} className="button">
                            Add user
                        </InertiaLink>

                        <input
                            type="text"
                            className="form-input w-64 rounded-full"
                            placeholder="Filter users…"
                            defaultValue={query.search}
                            onChange={e => fetchUsers({ search: e.target.value })}
                        />
                    </div>

                    <table className="table">
                        <thead>
                            <tr>
                                <th>
                                    <SortToggle name="email" value={query.sort} onChange={sort => fetchUsers({ sort })}>
                                        Email
                                    </SortToggle>
                                </th>
                                <th>
                                    <SortToggle name="name" value={query.sort} onChange={sort => fetchUsers({ sort })}>
                                        Name
                                    </SortToggle>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {users.data.map(user => (
                                <tr
                                    key={user.id}
                                    className="tr-clickable"
                                    onClick={() => Inertia.visit(user.links.edit)}
                                >
                                    <td>{user.email}</td>
                                    <td>{user.name}</td>
                                </tr>
                            ))}
                        </tbody>
                    </table>

                    <p className="table-status">
                        {users.meta.total !== total_users_count ? (
                            <>
                                Displaying {users.meta.total} of {total_users_count}{' '}
                                {pluralize('subscriber', total_users_count)}.{' '}
                                <InertiaLink href={links.users.index} className="underline">
                                    Show all
                                </InertiaLink>
                            </>
                        ) : (
                            <>
                                Displaying all {total_users_count} {pluralize('subscriber', total_users_count)}.
                            </>
                        )}
                    </p>

                    <Paginator
                        currentPage={users.meta.current_page}
                        lastPage={users.meta.last_page}
                        onChange={page => fetchUsers({ page })}
                    />
                </section>
            </main>
        </Layout>
    );
}
