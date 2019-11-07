import React from 'react';
import { InertiaLink } from '@inertiajs/inertia-react';

type Props = {
    href: string;
    children: React.ReactNode;
};

export default function NavigationLink({ href, children }: Props) {
    function activeClass(routeUrl: string) {
        return window.location.href.startsWith(routeUrl) ? 'is-active' : '';
    }
    return (
        <InertiaLink className={`${activeClass(href)} hover:text-green-500`} href={href}>
            {children}
        </InertiaLink>
    );
}
