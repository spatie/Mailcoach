import React from 'react';

type Props = {
    on: boolean;
    label?: React.ReactNode;
    className?: string;
    style?: React.CSSProperties;
    [key: string]: any;
};

export default function Toggle({ on = false, disabled = false, label = '', className = '', ...props }: Props) {
    return (
        <button className={`toggle ${on ? 'toggle-on' : 'toggle-off'} ${className}`} disabled={disabled} {...props}>
            <span className="toggle-button" />
            {label && <p className="toggle-label">{label}</p>}
        </button>
    );
}
