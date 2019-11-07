namespace Inertia {
    interface PageProps {
        flash: {
            message: string;
            type: 'success' | 'error';
        };
        errors: ValidationErrors;
        current_user: User;
        links: {
            login: string;
            forgot_password: string;
            account: {
                index: string;
                password: string;
                logout: string;
            };
            campaigns: {
                index: string;
                create: string;
                store: string;
            };
            templates: {
                index: string;
                create: string;
            };
            email_lists: {
                index: string;
                create: string;
                store: string;
            };
            subscribers: {
                index: string;
                create: string;
                import: string;
            };
            configuration: {
                index: string;
            };
            users: {
                index: string;
                create: string;
            };
        };
        request: {
            path: string;
            query: {
                sort: string;
                page: number;
                filter: { [key: string]: string };
            };
        };
    }
}

type ValidationErrors = {
    [key: string]: Array<string>;
};

interface Window {
    __webpack_public_path__: string;
}
