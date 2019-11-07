import React from 'react';

type Props = {
    name?: string;
    label?: string;
    value: boolean;
    className?: string;
    onChange: (value: boolean) => void;
};

export default function CheckboxField({ name, label, value, className, onChange }: Props) {
    function handleChange(event: React.ChangeEvent<HTMLInputElement>) {
        onChange(event.target.checked);
    }

    return (
        <label className={`flex items-center justify-start text-gray-600 ${className}`} tabIndex={0}>
            <input
                className="form-checkbox text-green-300 mr-2"
                type="checkbox"
                id={name}
                name={name}
                checked={value}
                onChange={handleChange}
                tabIndex={-1}
            />
            {!!label && <span className="flex-1">{label}</span>}
        </label>
    );
}
