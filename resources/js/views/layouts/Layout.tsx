import React, { useEffect } from 'react';
import Navigation from 'views/layouts/components/Navigation';
import { usePage } from '@inertiajs/inertia-react';
import Flash from 'views/layouts/components/Flash';

type Props = {
    children: React.ReactNode;
    title?: string;
};

export default function Layout({ children, title }: Props) {
    useEffect(() => {
        document.title = `${title} – Email Campaigns`;
    }, [title]);

    const { current_user } = usePage();

    return (
        <div>
            {current_user && <Navigation />}
            <Flash />
            {children}
        </div>
    );
}
