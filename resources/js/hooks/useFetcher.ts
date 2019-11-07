import useDebounce from './useDebounce';
import { Inertia } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/inertia-react';
import { stringify } from 'qs';
import { defaultsDeep, mapValues } from 'lodash';

type FetcherOptions = {
    key: string;
    url: string;
    defaultSort?: string;
};

type QueryParams = {
    sort: string;
    page: number;
    [key: string]: any;
};

type Fetcher = (query: Partial<QueryParams>) => void;

export default function useFetcher({ key, url, defaultSort }: FetcherOptions): [QueryParams, Fetcher] {
    const { request } = usePage();

    const debouncedFetch = useDebounce(
        ({ sort, page, ...filter }: Partial<QueryParams>) => {
            const queryParams = defaultsDeep({ sort, page, filter }, request.query);

            if (queryParams.sort === defaultSort) {
                queryParams.sort = undefined;
            }

            if (!queryParams.sort) {
                queryParams.sort = undefined;
            }

            if (queryParams.page === 1) {
                queryParams.page = undefined;
            }

            queryParams.filter = mapValues(queryParams.filter, value => {
                return value ? value : undefined;
            });

            const queryString = stringify(queryParams, { skipNulls: true, sort: alphabeticalSort });

            Inertia.visit(queryString ? `${url}?${queryString}` : url, {
                preserveState: true,
                preserveScroll: queryParams.page !== request.query.page,
                only: [key, 'request'],
            });
        },
        [request, key, url, defaultSort]
    );

    const { sort, page, filter } = request.query;

    return [{ sort: sort || defaultSort, page: page || 1, ...filter } as QueryParams, debouncedFetch];
}

function alphabeticalSort(a: string, b: string): number {
    return a.localeCompare(b);
}
