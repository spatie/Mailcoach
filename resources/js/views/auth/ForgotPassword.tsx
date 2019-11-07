import React from 'react';

import Layout from '../layouts/Layout';
import { InertiaLink } from '@inertiajs/inertia-react';
import FormError from 'components/FormError';

type Props = Inertia.PageProps;

export default function Login({ links }: Props) {
    return (
        <Layout title="Request password reset">
            <main className="grid min-h-screen place-center">
                <form className="card card-grid shadow-xl" method="POST" action={links.forgot_password}>
                    <h1 className="markup-h1">Request password reset</h1>

                    <InertiaLink className="link" href={links.login}>
                        Nevermind, I recall
                    </InertiaLink>

                    <div className="grid gap-1">
                        <label htmlFor="email">Email</label>
                        <input className="form-input" type="email" name="email" />
                        <FormError name="email" />
                    </div>

                    <button className="button" type="submit">
                        Request password reset link
                    </button>
                </form>
            </main>
        </Layout>
    );
}
