import React from 'react';
import { useForm } from '../../forms';
import { confirm } from '../../util/index';
import { Inertia } from '@inertiajs/inertia';
import SubscriberFormFields from './partials/SubscriberFormFields';
import SubscriberLayout from 'views/subscribers/layouts/SubscriberLayout';

type Props = Inertia.PageProps & {
    subscriber: App.SubscriberResource;
    emailListOptions: App.Options;
};

export default function Edit({ subscriber, emailListOptions }: Props) {
    const form = useForm(subscriber, subscriber.links.update, 'PUT');

    async function handleDelete() {
        confirm({
            action: 'Delete',
            buttonClassName: 'button-delete',
            text: `Are you sure you want to delete ${subscriber.email}? `,
            onConfirm: () => Inertia.delete(subscriber.links.delete),
        });
    }

    return (
        <SubscriberLayout title="Edit subscriber" activeTab="details" subscriber={subscriber}>
            <form className="card-grid" onSubmit={form.submit}>
                <SubscriberFormFields form={form} emailListOptions={emailListOptions} />

                <div className="buttons">
                    <button type="submit" className="button">
                        Save
                    </button>
                    <button type="button" className="link-delete" onClick={handleDelete}>
                        Delete
                    </button>
                </div>
            </form>
        </SubscriberLayout>
    );
}
