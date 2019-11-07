import React from 'react';
import Field from './Field';

type Props = {
    name?: string;
    label?: string;
    required?: boolean;
    error?: string;
    value: string | null;
    className?: string;
    onChange: (value: string) => void;
    options: App.Options;
};

export default function SelectField({ options, name, label, error, value, required, className = '', onChange }: Props) {
    function handleChange(event: React.ChangeEvent<HTMLSelectElement>) {
        onChange(event.target.value);
    }

    return (
        <Field label={label} name={name} error={error} required={required} className={`grid gap-1 ${className}`}>
            <select
                className="form-select form-input w-full max-w-2xl"
                id={name}
                name={name}
                required={required}
                value={value || ''}
                onChange={handleChange}
            >
                <option value="" disabled={true}>
                    Select an option
                </option>
                {options.map(({ label, value }, index) => (
                    <option key={index} value={value}>
                        {label}
                    </option>
                ))}
            </select>
        </Field>
    );
}
