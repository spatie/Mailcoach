import React from 'react';

type Props = React.HTMLAttributes<HTMLDivElement> & {
    name?: string;
    label?: string;
    error?: string;
    required?: boolean;
    children?: React.ReactNode;
    className?: string;
};

export default function Field({ name, label, required, children, error, className = '' }: Props) {
    return (
        <div className={`${className}`}>
            {!!label && (
                <label className="text-gray-600" htmlFor={name}>
                    {label} {required === false ? '' : <span className="text-gray-400">*</span>}
                </label>
            )}
            <div>
                {children}
                {!!error && <div className="mt-2 text-sm text-red-400">{error}</div>}
            </div>
        </div>
    );
}
