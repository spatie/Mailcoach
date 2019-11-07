import React from 'react';
import { InertiaLink } from '@inertiajs/inertia-react';

type Props = {
    href: string;
    name: string;
    activeName: string;
    children: React.ReactNode;
};

export default function Tab({ href, name, activeName, children }: Props) {
    return (
        <li className={name === activeName ? 'is-active' : ''}>
            <InertiaLink href={href}>{children}</InertiaLink>
        </li>
    );
}
