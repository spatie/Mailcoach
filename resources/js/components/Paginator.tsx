import React from 'react';

type Props = {
    currentPage: number;
    lastPage: number;
    onChange: (page: number) => void;
    labels?: { previous: string; next: string };
};

export default function Paginator({ currentPage, lastPage, labels, onChange }: Props) {
    const hasPrevious = currentPage > 1;
    const hasNext = currentPage < lastPage;

    if (!hasNext && !hasPrevious) {
        return null;
    }

    return (
        <nav className="grid cols-auto justify-center gap-4">
            <button
                className={hasPrevious ? 'link' : 'text-gray-500'}
                disabled={!hasPrevious}
                onClick={() => onChange(currentPage - 1)}
            >
                <i className="mr-2 fas fa-angle-left opacity-50"></i>
                {labels ? labels.previous : 'Previous'}
            </button>
            <button
                className={hasNext ? 'link' : 'text-gray-500'}
                disabled={!hasNext}
                onClick={() => onChange(currentPage + 1)}
            >
                {labels ? labels.next : 'Next'}
                <i className="ml-2 fas fa-angle-right opacity-50"></i>
            </button>
        </nav>
    );
}
