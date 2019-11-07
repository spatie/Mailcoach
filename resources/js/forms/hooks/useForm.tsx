import React, { useEffect, useState } from 'react';
import { cloneDeep, get, set } from 'lodash';
import { Inertia } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/inertia-react';

export default function useForm<T extends object>(
    initialValues: T,
    action: string = '',
    method: string = 'POST'
): Forms.Form<T> {
    const { errors } = usePage();

    const [values, setValues] = useState(initialValues);

    const [hasChanged, setHasChanged] = useState(false);

    useEffect(() => {
        window.addEventListener('beforeunload', function(e) {
            if (!hasChanged) {
                return undefined;
            }

            const confirmationMessage = 'Your changes will be lost';

            (e || window.event).returnValue = confirmationMessage;
            return confirmationMessage;
        });

        return () => {
            window.onbeforeunload = null;
        };
    }, []);

    function submit(event?: React.FormEvent) {
        if (event) {
            event.preventDefault();
        }

        Inertia.visit(action, {
            method,
            data: values,
            preserveState: true,
        });
    }

    function reset() {
        const newValues = cloneDeep(values);

        for (const [fieldName] of Object.entries(newValues)) {
            set(newValues, fieldName, '');
        }

        setValues(newValues);
    }

    function getInputProps(fieldName: string) {
        function handleChange(value: any) {
            const newValues = cloneDeep(values);
            set(newValues, fieldName, value);

            setValues(newValues);
            setHasChanged(true);
        }

        const value = get(values, fieldName);

        if (value === undefined) {
            console.error(`The form value for [${fieldName}] was undefined.`);
        }

        return {
            name: fieldName,
            value,
            error: get(errors, [fieldName, 0], ''),
            onChange: handleChange,
        };
    }

    return { values, setValues, reset, submit, getInputProps };
}
