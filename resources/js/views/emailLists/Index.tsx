import React, { useState } from 'react';
import Layout from '../layouts/Layout';
import SortToggle from 'components/SortToggle';
import Paginator from 'components/Paginator';
import { InertiaLink } from '@inertiajs/inertia-react';
import { format, parseISO } from 'date-fns';
import { Inertia } from '@inertiajs/inertia';
import { pluralize } from '../../util/index';
import useFetcher from '../../hooks/useFetcher';
import { TextField, useForm } from 'forms';
import Modal from 'components/Modal';

type Props = Inertia.PageProps & {
    email_lists: App.ResourceCollection<App.EmailListResource>;
    total_email_lists_count: number;
};

export default function Index({ email_lists, total_email_lists_count, links }: Props) {
    const [query, fetchEmailLists] = useFetcher({
        key: 'emailLists',
        url: links.email_lists.index,
        defaultSort: 'name',
    });

    const [createModalOpen, setCreateModalOpen] = useState<boolean>(false);
    const form = useForm({ name: '' }, links.email_lists.store, 'POST');

    return (
        <Layout title="Email lists">
            <main className="layout-main">
                <section className="card card-grid">
                    <h1 className="markup-h1">Email lists</h1>

                    <div className="flex justify-between">
                        <button className="button" onClick={() => setCreateModalOpen(true)}>
                            Create a new email list
                        </button>
                        {createModalOpen && (
                            <Modal title="Create a new email list" onDismiss={() => setCreateModalOpen(false)}>
                                <form className="card-grid" onSubmit={form.submit}>
                                    <TextField label="Name" {...form.getInputProps('name')} />
                                    <div className="buttons">
                                        <button type="submit" className="button">
                                            Create new email list
                                        </button>
                                    </div>
                                </form>
                            </Modal>
                        )}
                        <input
                            type="text"
                            className="form-input w-64 rounded-full"
                            placeholder="Filter email lists…"
                            defaultValue={query.search}
                            onChange={e => fetchEmailLists({ search: e.target.value })}
                        />
                    </div>

                    <table className="table">
                        <thead>
                            <tr>
                                <th>
                                    <SortToggle
                                        name="name"
                                        value={query.sort}
                                        onChange={sort => fetchEmailLists({ sort })}
                                    >
                                        Name
                                    </SortToggle>
                                </th>
                                <th>Active subscriptions</th>
                                <th className="th-numeric">
                                    <SortToggle
                                        name="created_at"
                                        value={query.sort}
                                        onChange={sort => fetchEmailLists({ sort })}
                                    >
                                        Created
                                    </SortToggle>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {email_lists.data.map(email_list => (
                                <tr
                                    key={email_list.id}
                                    className="tr-clickable"
                                    onClick={() => Inertia.visit(email_list.links.settings)}
                                >
                                    <td>{email_list.name}</td>
                                    <td>{email_list.active_subscription_count}</td>
                                    <td className="td-numeric">
                                        {format(parseISO(email_list.created_at), 'yyyy-MM-dd')}
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>

                    <p className="table-status">
                        {email_lists.meta.total !== total_email_lists_count ? (
                            <>
                                Displaying {email_lists.meta.total} of {total_email_lists_count}{' '}
                                {pluralize('email list', total_email_lists_count)}.{' '}
                                <InertiaLink href={links.email_lists.index} className="underline">
                                    Show all
                                </InertiaLink>
                            </>
                        ) : (
                            <>
                                {total_email_lists_count > 0 && (
                                    <>
                                        Displaying all {total_email_lists_count}{' '}
                                        {pluralize('email list', total_email_lists_count)}.
                                    </>
                                )}

                                {total_email_lists_count === 0 && <>No email lists have been created yet.</>}
                            </>
                        )}
                    </p>

                    <Paginator
                        currentPage={email_lists.meta.current_page}
                        lastPage={email_lists.meta.last_page}
                        onChange={page => fetchEmailLists({ page })}
                    />
                </section>
            </main>
        </Layout>
    );
}
