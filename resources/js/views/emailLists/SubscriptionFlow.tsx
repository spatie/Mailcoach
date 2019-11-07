import React from 'react';
import { CheckboxField, useForm } from 'forms';
import EmailListLayout from 'views/emailLists/layouts/EmailListLayout';

type Props = Inertia.PageProps & {
    email_list: App.EmailListResource;
};

export default function Settings({ email_list }: Props) {
    const form = useForm(email_list, email_list.links.subscription_flow, 'PUT');

    return (
        <EmailListLayout
            emailList={email_list}
            title={`${email_list.name} subscription flow`}
            activeTab="subscriptionFlow"
        >
            <form className="card-grid" onSubmit={form.submit}>
                <CheckboxField label="Requires double opt in" {...form.getInputProps('requires_double_opt_in')} />
                <div className="buttons">
                    <button type="submit" className="button">
                        Save
                    </button>
                </div>
            </form>
        </EmailListLayout>
    );
}
