import React from 'react';
import { useForm } from '../../forms';
import { confirm } from '../../util/index';
import { Inertia } from '@inertiajs/inertia';
import TemplateFormFields from './partials/TemplateFormFields';
import Layout from 'views/layouts/Layout';

type Props = Inertia.PageProps & {
    template: App.TemplateResource;
};

export default function Edit({ template }: Props) {
    const form = useForm(template, template.links.edit, 'PUT');

    async function handleDelete() {
        confirm({
            action: 'Delete',
            buttonClassName: 'button-delete',
            text: `Are you sure you want to delete ${template.name}? `,
            onConfirm: () => Inertia.delete(template.links.delete),
        });
    }

    return (
        <Layout title="Edit subscriber">
            <form className="card-grid" onSubmit={form.submit}>
                <TemplateFormFields form={form} />

                <div className="buttons">
                    <button type="submit" className="button">
                        Save
                    </button>
                    <button type="button" className="link-delete" onClick={handleDelete}>
                        Delete
                    </button>
                </div>
            </form>
        </Layout>
    );
}
