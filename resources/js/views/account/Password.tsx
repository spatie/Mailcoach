import React from 'react';
import AccountLayout from 'views/account/layouts/AccountLayout';
import { TextField, useForm } from 'forms';

type Props = Inertia.PageProps;

export default function Password({ links }: Props) {
    const form = useForm(
        {
            current_password: '',
            password: '',
            password_confirmation: '',
        },
        links.account.password,
        'PUT'
    );

    function onSubmit(event?: React.FormEvent) {
        form.submit(event);

        form.reset();
    }

    return (
        <AccountLayout activeTab="password" title="Password">
            <h1 className="markup-h1">Password</h1>

            <form className="card-grid" onSubmit={onSubmit}>
                <TextField
                    name="current_password"
                    type="password"
                    label="Current password"
                    {...form.getInputProps('current_password')}
                />
                <TextField name="password" type="password" label="New password" {...form.getInputProps('password')} />
                <TextField
                    name="password_confirmation"
                    type="password"
                    label="New password (again)"
                    {...form.getInputProps('password_confirmation')}
                />

                <div className="buttons">
                    <button className="button" type="submit">
                        Save
                    </button>
                </div>
            </form>
        </AccountLayout>
    );
}
