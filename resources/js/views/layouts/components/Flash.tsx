import React from 'react';
import { usePage } from '@inertiajs/inertia-react';

export default function Flash() {
    const { flash } = usePage();

    return flash && <div className={flash.type === 'success' ? 'bg-green-200' : 'bg-red-200'}>{flash.message}</div>;
}
