import React from 'react';

import Layout from '../layouts/Layout';
import FormError from 'components/FormError';

type Props = Inertia.PageProps;

export default function ResetPassword({ links }: Props) {
    return (
        <Layout title="Reset Password">
            <main className="grid min-h-screen place-center">
                <form className="card card-grid shadow-xl" method="POST" action={links.login}>
                    <h1 className="markup-h1">Reset Password</h1>

                    <div>
                        <label htmlFor="email">Email</label>
                        <input className="form-input" type="email" name="email" />
                        <FormError name="email" />
                    </div>

                    <div>
                        <label htmlFor="password">Password</label>
                        <input className="form-input" type="password" name="password" />
                        <FormError name="password" />
                    </div>

                    <div>
                        <label htmlFor="password_confirmation">Confirm password</label>
                        <input className="form-input" type="password" name="password_confirmation" />
                        <FormError name="password_confirmation" />
                    </div>

                    <button className="button" type="submit">
                        Change password
                    </button>
                </form>
            </main>
        </Layout>
    );
}
