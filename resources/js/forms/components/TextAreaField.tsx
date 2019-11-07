import React from 'react';
import Field from './Field';

type Props = {
    name?: string;
    label?: string;
    rows?: number;
    required?: boolean;
    error?: string;
    value: string | null;
    className?: string;
    onChange: (value: string) => void;
};

export default function TextAreaField({
    rows = 10,
    name,
    label,
    error,
    value,
    required,
    className = '',
    onChange,
}: Props) {
    function handleChange(event: React.ChangeEvent<HTMLTextAreaElement>) {
        onChange(event.target.value);
    }

    return (
        <Field label={label} name={name} error={error} required={required} className={`grid gap-1 ${className}`}>
            <textarea
                className="form-textarea w-full max-w-2xl"
                rows={rows}
                id={name}
                name={name}
                required={required}
                value={value || ''}
                autoComplete="off"
                onChange={handleChange}
            />
        </Field>
    );
}
