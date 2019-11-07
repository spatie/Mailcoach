import React from 'react';
import { startsWith, trimStart } from 'lodash';

type Props = {
    name: string;
    value?: string;
    onChange: (sort: string) => void;
    children: React.ReactNode;
    className?: string;
};

export default function SortToggle({ name, value, onChange, className, children }: Props) {
    const isActive = trimStart(value, '-') === name;
    const isDesc = startsWith(value, '-');

    function handleClick(event: React.MouseEvent) {
        event.preventDefault();

        onChange(isActive ? `${isDesc ? '' : '-'}${name}` : name);
    }

    return (
        <button onClick={handleClick} className={`${className} focus:outline-none`}>
            {children}
            {isActive && (isDesc ? ' ↓' : ' ↑')}
        </button>
    );
}
