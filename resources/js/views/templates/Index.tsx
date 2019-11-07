import React from 'react';
import Layout from '../layouts/Layout';
import useFetcher from 'hooks/useFetcher';
import SortToggle from 'components/SortToggle';
import Paginator from 'components/Paginator';
import { pluralize } from '../../util/index';
import { InertiaLink } from '@inertiajs/inertia-react';
import { Inertia } from '@inertiajs/inertia';

type Props = Inertia.PageProps & {
    templates: App.ResourceCollection<App.TemplateResource>;
    total_templates_count: number;
};

export default function Index({ templates, total_templates_count, links }: Props) {
    const [query, fetchTemplates] = useFetcher({
        key: 'templates',
        url: links.templates.index,
        defaultSort: 'name',
    });

    return (
        <Layout title="Templates">
            <main className="layout-main">
                <section className="card card-grid">
                    <h1 className="markup-h1">Templates</h1>

                    <div className="flex justify-between">
                        <InertiaLink href={links.templates.create} className="button">
                            Add template
                        </InertiaLink>

                        <input
                            type="text"
                            className="form-input w-64 rounded-full"
                            placeholder="Filter templates…"
                            defaultValue={query.search}
                            onChange={e => fetchTemplates({ search: e.target.value })}
                        />
                    </div>

                    <table className="table">
                        <thead>
                            <tr>
                                <th>
                                    <SortToggle
                                        name="name"
                                        value={query.sort}
                                        onChange={sort => fetchTemplates({ sort })}
                                    >
                                        Name
                                    </SortToggle>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {templates.data.map(template => (
                                <tr
                                    key={template.id}
                                    className="tr-clickable"
                                    onClick={() => Inertia.visit(template.links.edit)}
                                >
                                    <td>{template.name}</td>
                                </tr>
                            ))}
                        </tbody>
                    </table>

                    <p className="table-status">
                        {templates.meta.total !== total_templates_count ? (
                            <>
                                Displaying {templates.meta.total} of {total_templates_count}{' '}
                                {pluralize('template', total_templates_count)}.{' '}
                                <InertiaLink href={links.templates.index} className="underline">
                                    Show all
                                </InertiaLink>
                            </>
                        ) : (
                            <>
                                {total_templates_count > 0 && (
                                    <>
                                        Displaying all {total_templates_count}{' '}
                                        {pluralize('template', total_templates_count)}.
                                    </>
                                )}
                                {total_templates_count === 0 && <>No templates have been created yet.</>}
                            </>
                        )}
                    </p>

                    <Paginator
                        currentPage={templates.meta.current_page}
                        lastPage={templates.meta.last_page}
                        onChange={page => fetchTemplates({ page })}
                    />
                </section>
            </main>
        </Layout>
    );
}
