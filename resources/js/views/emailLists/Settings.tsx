import React from 'react';
import { Inertia } from '@inertiajs/inertia';
import { TextField, useForm } from '../../forms';
import { confirm } from '../../util/index';
import EmailListLayout from 'views/emailLists/layouts/EmailListLayout';

type Props = Inertia.PageProps & {
    email_list: App.EmailListResource;
};

export default function Settings({ email_list }: Props) {
    const form = useForm(email_list, email_list.links.settings, 'PUT');

    async function handleDelete() {
        confirm({
            action: 'Delete',
            buttonClassName: 'button-delete',
            text: `Are you sure you want to delete the list ${email_list.name}? `,
            onConfirm: () => Inertia.delete(email_list.links.destroy),
        });
    }

    return (
        <EmailListLayout emailList={email_list} title={`${email_list.name} settings`} activeTab="settings">
            <form className="card-grid" onSubmit={form.submit}>
                <TextField label="Name" {...form.getInputProps('name')} />

                <div className="buttons">
                    <button type="submit" className="button">
                        Save
                    </button>
                    <button type="button" className="link-delete" onClick={handleDelete}>
                        Delete
                    </button>
                </div>
            </form>
        </EmailListLayout>
    );
}
