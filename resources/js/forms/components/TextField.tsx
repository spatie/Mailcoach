import React from 'react';
import Field from './Field';

type Props = {
    name?: string;
    label?: string;
    required?: boolean;
    type?: 'text' | 'password' | 'email' | 'hidden';
    error?: string;
    value: string | null;
    placeholder?: string;
    className?: string;
    onChange: (value: string) => void;
};

export default function TextField({
    type = 'text',
    name,
    label,
    error,
    value,
    required,
    placeholder,
    className = '',
    onChange,
}: Props) {
    function handleChange(event: React.ChangeEvent<HTMLInputElement>) {
        onChange(event.target.value);
    }

    return (
        <Field label={label} name={name} error={error} required={required} className={`grid gap-1 ${className}`}>
            <input
                className="form-input w-full max-w-2xl"
                type={type}
                id={name}
                name={name}
                required={required}
                placeholder={placeholder}
                value={value || ''}
                autoComplete="off"
                onChange={handleChange}
            />
        </Field>
    );
}
