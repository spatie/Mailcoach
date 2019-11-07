import React from 'react';
import { CheckboxesField, TextField } from 'forms';

type Props = {
    form: Forms.Form<App.SubscriberResource>;
    emailListOptions: App.Options;
};

export default function SubscriberFormFields({ form, emailListOptions }: Props) {
    return (
        <>
            <TextField label="Email" {...form.getInputProps('email')} />

            <TextField label="First name" required={false} {...form.getInputProps('first_name')} />
            <TextField label="Last name" required={false} {...form.getInputProps('last_name')} />

            <h2>Subscribed to</h2>
            <CheckboxesField options={emailListOptions} {...form.getInputProps('email_list_ids')} />
        </>
    );
}
