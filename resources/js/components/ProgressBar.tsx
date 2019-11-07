import React from 'react';

type Props = {
    value: number;
    className?: string;
    valueClassName?: string;
};

export default function Progressbar({ value, className = '', valueClassName = '', ...props }: Props) {
    return (
        <div className={`progress-bar ${className}`} title={`${value}%`} {...props}>
            <div className={`progress-bar-value ${valueClassName}`} style={{ width: `${value}%` }} />
        </div>
    );
}
