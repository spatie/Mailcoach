import React, { useState } from 'react';

type SubscriptionStatusFilter = 'pending' | 'subscribed' | 'unsubscribed';

export default function SubscriptionStatusFilter() {
    const [subscriptionStatusFilter, updateSubscriptionStatusFilter] = useState('subscribed');

    function changeFilter(statusFilter: SubscriptionStatusFilter) {
        updateSubscriptionStatusFilter(statusFilter);
    }

    function allFilters(): Array<SubscriptionStatusFilter> {
        return ['pending', 'subscribed', 'unsubscribed'];
    }

    return (
        <ul>
            {allFilters().map(filter => (
                <li
                    onClick={() => changeFilter(filter)}
                    className={subscriptionStatusFilter === filter ? 'is-active' : ''}
                >
                    {filter}
                </li>
            ))}
        </ul>
    );
}
