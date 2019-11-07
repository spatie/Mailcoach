import React from 'react';
import { InertiaApp } from '@inertiajs/inertia-react';
import { render } from 'react-dom';

const app = document.getElementById('app');

if (module.hot) {
    window.setTimeout(() => {
        if (module.hot && module.hot.data && module.hot.data.scrollPosition) {
            window.scrollTo(0, module.hot.data.scrollPosition);
        }
    }, 100);

    const firstVisit = window.location.pathname;

    module.hot.accept();

    module.hot.dispose(data => {
        if (firstVisit !== window.location.pathname) {
            window.location.reload();
        } else {
            data.scrollPosition = window.pageYOffset;
        }
    });
}

if (app) {
    render(
        <InertiaApp
            initialPage={JSON.parse(app.dataset.page as string)}
            resolveComponent={async (component: string) => {
                return (await import(`./views/${viewPath(component)}`)).default;
            }}
        />,
        app
    );
}

function viewPath(viewName: string): string {
    const [componentName, ...parts] = viewName.split('.').reverse();

    return `${parts.reverse().join('/')}/${componentName}`;
}
