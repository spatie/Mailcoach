import React from 'react';
import Layout from '../layouts/Layout';
import useFetcher from 'hooks/useFetcher';
import SortToggle from 'components/SortToggle';
import Paginator from 'components/Paginator';
import { pluralize } from '../../util/index';
import { InertiaLink } from '@inertiajs/inertia-react';
import { Inertia } from '@inertiajs/inertia';
import { format, parseISO } from 'date-fns';

type Props = Inertia.PageProps & {
    subscribers: App.ResourceCollection<App.SubscriberResource>;
    total_subscribers_count: number;
};

export default function Index({ subscribers, total_subscribers_count, links }: Props) {
    const [query, fetchSubscribers] = useFetcher({
        key: 'subscribers',
        url: links.subscribers.index,
        defaultSort: '-created_at',
    });

    return (
        <Layout title="Subscribers">
            <main className="layout-main">
                <section className="card card-grid">
                    <h1 className="markup-h1">Subscribers</h1>

                    <div className="flex justify-between">
                        <InertiaLink href={links.subscribers.create} className="button">
                            Add subscriber
                        </InertiaLink>

                        <InertiaLink href={links.subscribers.import} className="button">
                            Import subscribers
                        </InertiaLink>

                        <input
                            type="text"
                            className="form-input w-64 rounded-full"
                            placeholder="Filter subscribers…"
                            defaultValue={query.search}
                            onChange={e => fetchSubscribers({ search: e.target.value })}
                        />
                    </div>

                    <table className="table">
                        <thead>
                            <tr>
                                <th>
                                    <SortToggle
                                        name="email"
                                        value={query.sort}
                                        onChange={sort => fetchSubscribers({ sort })}
                                    >
                                        Email
                                    </SortToggle>
                                </th>
                                <th>
                                    <SortToggle
                                        name="first_name"
                                        value={query.sort}
                                        onChange={sort => fetchSubscribers({ sort })}
                                    >
                                        First name
                                    </SortToggle>
                                </th>
                                <th>
                                    <SortToggle
                                        name="last_name"
                                        value={query.sort}
                                        onChange={sort => fetchSubscribers({ sort })}
                                    >
                                        Last name
                                    </SortToggle>
                                </th>
                                <th>Subscriptions</th>
                                <th className="th-numeric">
                                    <SortToggle
                                        name="created_at"
                                        value={query.sort}
                                        onChange={sort => fetchSubscribers({ sort })}
                                    >
                                        Created at
                                    </SortToggle>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {subscribers.data.map(subscriber => (
                                <tr
                                    key={subscriber.id}
                                    className="tr-clickable"
                                    onClick={() => Inertia.visit(subscriber.links.edit)}
                                >
                                    <td>{subscriber.email}</td>
                                    <td>{subscriber.first_name}</td>
                                    <td>{subscriber.last_name}</td>
                                    <td>{subscriber.email_list_ids.length}</td>
                                    <td className="td-numeric">
                                        {format(parseISO(subscriber.created_at), 'yyyy-MM-dd')}
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>

                    <p className="table-status">
                        {subscribers.meta.total !== total_subscribers_count ? (
                            <>
                                Displaying {subscribers.meta.total} of {total_subscribers_count}{' '}
                                {pluralize('subscriber', total_subscribers_count)}.{' '}
                                <InertiaLink href={links.subscribers.index} className="underline">
                                    Show all
                                </InertiaLink>
                            </>
                        ) : (
                            <>
                                {total_subscribers_count > 0 && (
                                    <>
                                        Displaying all {total_subscribers_count}{' '}
                                        {pluralize('subscriber', total_subscribers_count)}.
                                    </>
                                )}
                                {total_subscribers_count === 0 && <>Nobody has subscribed yet.</>}
                            </>
                        )}
                    </p>

                    <Paginator
                        currentPage={subscribers.meta.current_page}
                        lastPage={subscribers.meta.last_page}
                        onChange={page => fetchSubscribers({ page })}
                    />
                </section>
            </main>
        </Layout>
    );
}
