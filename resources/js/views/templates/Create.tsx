import React from 'react';
import Layout from 'views/layouts/Layout';
import { InertiaLink } from '@inertiajs/inertia-react';
import { useForm } from '../../forms';
import TemplateFormFields from './partials/TemplateFormFields';

type Props = Inertia.PageProps & {
    template: App.TemplateResource;
};

export default function Create({ template, links }: Props) {
    const form = useForm(template, template.links.store, 'POST');

    return (
        <Layout title="Create template">
            <main className="layout-main">
                <section className="card card-grid">
                    <nav className="breadcrumbs">
                        <ul>
                            <li>
                                <InertiaLink href={links.templates.index}>Templates</InertiaLink>
                            </li>
                            <li>Create a new template</li>
                        </ul>
                    </nav>

                    <form className="card-grid" onSubmit={form.submit}>
                        <TemplateFormFields form={form} />

                        <div className="buttons">
                            <button type="submit" className="button">
                                Save
                            </button>
                        </div>
                    </form>
                </section>
            </main>
        </Layout>
    );
}
