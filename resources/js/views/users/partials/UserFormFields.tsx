import React from 'react';
import { TextField } from 'forms';

type Props = {
    form: Forms.Form<App.UserResource>;
};

export default function UserFormFields({ form }: Props) {
    return (
        <>
            <TextField label="Email" {...form.getInputProps('email')} />

            <TextField label="Name" required={false} {...form.getInputProps('name')} />
        </>
    );
}
