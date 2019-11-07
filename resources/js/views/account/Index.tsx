import React from 'react';
import AccountLayout from 'views/account/layouts/AccountLayout';
import { TextField, useForm } from 'forms';

type Props = Inertia.PageProps & {
    user: App.UserResource;
};

export default function Index({ links, user }: Props) {
    const form = useForm(user, links.account.index, 'PUT');

    return (
        <AccountLayout activeTab="account" title="Account">
            <h1 className="markup-h1">Account</h1>
            <form className="card-grid" onSubmit={form.submit}>
                <TextField name="email" type="email" label="Email" {...form.getInputProps('email')} />
                <TextField name="name" label="Name" {...form.getInputProps('name')} />
                <div className="buttons">
                    <button className="button" type="submit">
                        Save
                    </button>
                </div>
            </form>
        </AccountLayout>
    );
}
