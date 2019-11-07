import React from 'react';

import Layout from '../layouts/Layout';
import { InertiaLink } from '@inertiajs/inertia-react';
import FormError from 'components/FormError';

type Props = Inertia.PageProps;

export default function Login({ links }: Props) {
    return (
        <Layout title="Log in">
            <main className="grid min-h-screen place-center">
                <form className="card card-grid shadow-xl p-16" method="POST" action={links.login}>
                    <h1 className="markup-h1">Login</h1>

                    <InertiaLink className="link" href={links.forgot_password}>
                        Forgot password?
                    </InertiaLink>

                    <div className="grid gap-1">
                        <label htmlFor="email">Email</label>
                        <input className="form-input" type="email" name="email" />
                        <FormError name="email" />
                    </div>

                    <div className="grid gap-1">
                        <label htmlFor="password">Password</label>
                        <input className="form-input" type="password" name="password" />
                        <FormError name="password" />
                    </div>

                    <button className="button" type="submit">
                        Log me in
                    </button>
                </form>
            </main>
        </Layout>
    );
}
