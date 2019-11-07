import React from 'react';
import { usePage } from '@inertiajs/inertia-react';

type Props = {
    name: string;
};

export default function FormError({ name }: Props) {
    const page = usePage();

    if (!page.errors[name]) {
        return null;
    }

    return <p className="text-red-700 text-right mt-2 text-sm">{page.errors[name][0]}</p>;
}
