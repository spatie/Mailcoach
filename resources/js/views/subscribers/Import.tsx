import React from 'react';
import { InertiaLink } from '@inertiajs/inertia-react';
import Layout from 'views/layouts/Layout';
import { SelectField, useForm } from 'forms';
import { format, parseISO } from 'date-fns';
import { confirm } from '../../util/index';
import { Inertia } from '@inertiajs/inertia';

type Props = Inertia.PageProps & {
    email_list_options: App.Options;
    subscriber_imports: Array<App.SubscriberImportResource>;
};

export default function Import({ subscriber_imports, email_list_options, links }: Props) {
    const form = useForm(
        {
            email_list_id: '',
        },
        links.subscribers.import,
        'PUT'
    );

    async function handleDelete(subscriberImport: App.SubscriberImportResource) {
        confirm({
            action: 'Delete',
            buttonClassName: 'button-delete',
            text: `Are you sure you want to delete this import`,
            onConfirm: () => Inertia.delete(subscriberImport.links.delete),
        });
    }

    return (
        <Layout title="Import subscribers">
            <main className="layout-main">
                <section className="card card-grid">
                    <nav className="breadcrumbs">
                        <ul>
                            <li>
                                <InertiaLink href={links.subscribers.index}>Subscribers</InertiaLink>
                            </li>
                            <li>Import subscribers</li>
                        </ul>
                    </nav>

                    {subscriber_imports.length > 0 && (
                        <>
                            <h2>Imports</h2>
                            <table className="table">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Started at</th>
                                        <th>Email list</th>
                                        <th className="th-numeric">Imported subscribers</th>
                                        <th className="th-numeric">Errors</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {subscriber_imports.map(subscriber_import => (
                                        <tr key={subscriber_import.id}>
                                            <td>
                                                <SubscriberImportIcon status={subscriber_import.status} />
                                            </td>
                                            <td className="td-numeric">
                                                {format(parseISO(subscriber_import.created_at), 'yyyy-MM-dd')}
                                            </td>
                                            <td>{subscriber_import.email_list.name}</td>
                                            <td className="td-numeric">
                                                {subscriber_import.imported_subscribers_count}
                                            </td>
                                            <td className="td-numeric">{subscriber_import.error_count}</td>
                                            <td>
                                                <a href={subscriber_import.imported_subscribers_report_url}>
                                                    Import report
                                                </a>
                                                <a href={subscriber_import.error_report_url}>Error report</a>
                                                <a href={subscriber_import.import_file_url}>Uploaded file</a>
                                                <button
                                                    type="button"
                                                    className="link-delete"
                                                    onClick={() => handleDelete(subscriber_import)}
                                                >
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </>
                    )}

                    <form className="card-grid" onSubmit={form.submit}>
                        <SelectField
                            label="Subscribe to email list"
                            {...form.getInputProps('email_list_id')}
                            options={email_list_options}
                        />

                        <input type="upload" name="file" />

                        <div className="buttons">
                            <button type="submit" className="button">
                                Import
                            </button>
                        </div>
                    </form>
                </section>
            </main>
        </Layout>
    );
}

function SubscriberImportIcon({ status }: { status: string }) {
    switch (status) {
        case 'pending':
            return <i title="Scheduled" className={`far fa-clock text-yellow-500`} />;
        case 'importing':
            return <i title="Sending" className={`fas fa-sync fa-spin text-blue-500`} />;
        case 'completed':
            return <i title="Sent" className={`fas fa-check text-green-500`} />;
        default:
            return null;
    }
}
