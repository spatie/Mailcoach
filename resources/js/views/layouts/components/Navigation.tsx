import React, { useState, useEffect } from 'react';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import NavigationLink from 'components/NavigationLink';

export default function Navigation() {
    const { links } = usePage();
    const [expanded, setExpanded] = useState(false);

    function toggleExpanded() {
        setExpanded(!expanded);
    }

    useEffect(() => {
        if (expanded) {
            window.addEventListener('click', toggleExpanded);
        }

        return () => {
            window.removeEventListener('click', toggleExpanded);
        };
    }, [expanded]);

    return (
        <header className="py-6 text-gray-700">
            <nav className="layout-col flex justify-between items-center">
                <InertiaLink href="/" className="group flex justify-start items-center leading-none">
                    <svg className="h-8 w-auto mr-2" viewBox="0 0 512 440">
                        <g className="opacity-0 group-hover:opacity-100">
                            <ellipse
                                transform="matrix(0.7071 -0.7071 0.7071 0.7071 -118.8743 389.8963)"
                                fill="#9AE6B4"
                                cx="411.2"
                                cy="338.4"
                                rx="92.8"
                                ry="92.8"
                            />
                            <ellipse
                                transform="matrix(0.7071 -0.7071 0.7071 0.7071 -210.0841 169.6964)"
                                fill="#9AE6B4"
                                cx="99.8"
                                cy="338.4"
                                rx="92.8"
                                ry="92.8"
                            />
                            <path
                                fill="#9AE6B4"
                                d="M444.5,30.9c0,0-113.8-21.4-189.6-21.4c-75.7,0-188.4,21.4-188.4,21.4l22.4,191.7
	c65.6,13.1,123.4,47.8,165.7,96.3l0.2,0.1c42.7-49,101-83.8,167.3-96.7L444.5,30.9z"
                            />
                        </g>
                        <g>
                            <path
                                fill="#4A5568"
                                d="M99.8,245.7C48.6,245.7,7,287.2,7,338.4s41.5,92.8,92.8,92.8c51.2,0,92.8-41.5,92.8-92.8
		S151,245.7,99.8,245.7z M99.8,391.6c-29.3,0-53.1-23.8-53.1-53.1s23.8-53.1,53.1-53.1c29.3,0,53.1,23.8,53.1,53.1
		S129.1,391.6,99.8,391.6z"
                            />
                            <path
                                fill="#4A5568"
                                d="M411.2,245.7c-51.2,0-92.8,41.5-92.8,92.8s41.5,92.8,92.8,92.8c51.2,0,92.8-41.5,92.8-92.8
		S462.5,245.7,411.2,245.7z M411.2,391.6c-29.3,0-53.1-23.8-53.1-53.1s23.8-53.1,53.1-53.1c29.3,0,53.1,23.8,53.1,53.1
		S440.5,391.6,411.2,391.6z"
                            />
                            <path
                                fill="#4A5568"
                                d="M444.5,30.9c0,0-113.8-21.4-189.6-21.4c-75.7,0-188.4,21.4-188.4,21.4l22.4,191.7
		c65.6,13.1,123.4,47.8,165.7,96.3l0.2,0.1c42.7-49,101-83.8,167.3-96.7L444.5,30.9z M254.9,49.1c45.6,0,107.2,8.4,145.8,14.6
		l-13.4,114.2L338,123.8l26-19.7l-17.3-22.9L257.1,149l-89.6-67.7l-17.3,22.9l25,18.9l-51.4,56.7L110.3,63.6
		C148.6,57.5,209.5,49.1,254.9,49.1z M254.7,262.8c-31.8-28.3-68.7-50.5-108.5-65.1l51.9-57.3l58.9,44.5l57.9-43.8l50.7,55.6
		C325,211.4,287.2,233.9,254.7,262.8z"
                            />
                        </g>
                    </svg>
                    <span className="font-bold text-lg">MailCoach</span>
                </InertiaLink>
                <ul className="grid cols-auto justify-end gap-6 leading-none">
                    <li>
                        <NavigationLink href={links.campaigns.index}>Campaigns</NavigationLink>
                    </li>
                    <li>
                        <NavigationLink href={links.templates.index}>Templates</NavigationLink>
                    </li>
                    <li>
                        <NavigationLink href={links.email_lists.index}>Email lists</NavigationLink>
                    </li>
                    <li>
                        <NavigationLink href={links.subscribers.index}>Subscribers</NavigationLink>
                    </li>
                    <li>
                        <button className="group" onClick={toggleExpanded}>
                            Service
                            <i
                                className={`${
                                    !expanded ? 'opacity-0' : ''
                                } fas fa-user absolute top-0 left-0 text-green-300 group-hover:opacity-100`}
                            ></i>
                            <i className="far fa-user z-10"></i>
                        </button>

                        {expanded && (
                            <div className="absolute right-0 -mr-2 z-10 p-6 bg-gray-200 shadow-xl">
                                <ul className="grid gap-6">
                                    <li>
                                        <InertiaLink className="hover:text-green-500" href={links.account.index}>
                                            Account
                                        </InertiaLink>
                                    </li>
                                    <li>
                                        <InertiaLink className="hover:text-green-500" href={links.users.index}>
                                            Users
                                        </InertiaLink>
                                    </li>
                                    <li>
                                        <InertiaLink className="hover:text-green-500" href={links.configuration.index}>
                                            Configuration
                                        </InertiaLink>
                                    </li>
                                    <li>
                                        <InertiaLink
                                            className="hover:text-green-500"
                                            method="POST"
                                            href={links.account.logout}
                                        >
                                            Log out
                                        </InertiaLink>
                                    </li>
                                </ul>
                            </div>
                        )}
                    </li>
                </ul>
            </nav>
        </header>
    );
}
