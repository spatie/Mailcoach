import React from 'react';
import EmailListLayout from 'views/emailLists/layouts/EmailListLayout';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink } from '@inertiajs/inertia-react';
import SortToggle from 'components/SortToggle';
import { pluralize } from '../../util/index';
import Paginator from 'components/Paginator';
import useFetcher from 'hooks/useFetcher';
import { format, parseISO } from 'date-fns';
import SubscriptionStatusFilter from 'components/SubscriptionStatusFilter';

type Props = Inertia.PageProps & {
    email_list: App.EmailListResource;
    subscriptions: App.ResourceCollection<App.SubscriptionResource>;
    total_subscriptions_count: number;
};

export default function Subscribers({ email_list, subscriptions, total_subscriptions_count, links }: Props) {
    const [query, fetchSubscriptions] = useFetcher({
        key: 'subscribers',
        url: email_list.links.subscribers,
        defaultSort: '-created_at',
    });

    return (
        <EmailListLayout emailList={email_list} title={`${email_list.name} subscribers`} activeTab="subscribers">
            <h1 className="markup-h1">Subscribers</h1>

            <div className="flex justify-between">
                <input
                    type="text"
                    className="form-input w-64 rounded-full"
                    placeholder="Filter subscribers…"
                    defaultValue={query.search}
                    onChange={e => fetchSubscriptions({ search: e.target.value })}
                />
                <SubscriptionStatusFilter />
            </div>

            <table className="table">
                <thead>
                    <tr>
                        <th>
                            <SortToggle name="email" value={query.sort} onChange={sort => fetchSubscriptions({ sort })}>
                                Email
                            </SortToggle>
                        </th>
                        <th>
                            <SortToggle
                                name="first_name"
                                value={query.sort}
                                onChange={sort => fetchSubscriptions({ sort })}
                            >
                                First name
                            </SortToggle>
                        </th>
                        <th>
                            <SortToggle
                                name="last_name"
                                value={query.sort}
                                onChange={sort => fetchSubscriptions({ sort })}
                            >
                                Last name
                            </SortToggle>
                        </th>
                        <th className="th-numeric">
                            <SortToggle
                                name="created_at"
                                value={query.sort}
                                onChange={sort => fetchSubscriptions({ sort })}
                            >
                                Subscribed at
                            </SortToggle>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {subscriptions.data.map(subscription => (
                        <tr
                            key={subscription.id}
                            className="tr-clickable"
                            onClick={() => Inertia.visit(subscription.links.edit)}
                        >
                            <td>{subscription.email}</td>
                            <td>{subscription.first_name}</td>
                            <td>{subscription.last_name}</td>
                            <td className="td-numeric">{format(parseISO(subscription.created_at), 'yyyy-MM-dd')}</td>
                        </tr>
                    ))}
                </tbody>
            </table>

            <p className="table-status">
                {subscriptions.meta.total !== total_subscriptions_count ? (
                    <>
                        Displaying {subscriptions.meta.total} of {total_subscriptions_count}{' '}
                        {pluralize('subscriber', total_subscriptions_count)}.{' '}
                        <InertiaLink href={links.subscribers.index} className="underline">
                            Show all
                        </InertiaLink>
                    </>
                ) : (
                    <>
                        {total_subscriptions_count > 0 && (
                            <>
                                Displaying all {total_subscriptions_count}{' '}
                                {pluralize('subscriber', total_subscriptions_count)}.
                            </>
                        )}
                        {total_subscriptions_count === 0 && <>Nobody has subscribed yet.</>}
                    </>
                )}
            </p>

            <Paginator
                currentPage={subscriptions.meta.current_page}
                lastPage={subscriptions.meta.last_page}
                onChange={page => fetchSubscriptions({ page })}
            />
        </EmailListLayout>
    );
}
