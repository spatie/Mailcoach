import React, { createContext, useContext, useMemo } from 'react';
import { createPortal } from 'react-dom';

type ModalContextType = {
    onDismiss: () => void;
};

const ModalContext = createContext<ModalContextType>({
    onDismiss: () => {},
});

type Props = {
    className?: string;
    title?: React.ReactNode;
    children: React.ReactNode;
    size?: 'base' | 'md' | 'lg';
    onDismiss?: () => void;
    confirmOnDismiss?: boolean;
};

export default function Modal({
    children,
    title,
    className = '',
    size = 'base',
    onDismiss,
    confirmOnDismiss = false,
    ...props
}: Props) {
    function dismissModal(checkConfirmation: boolean) {
        if (onDismiss) {
            if (checkConfirmation && confirmOnDismiss && !confirm('Close this form and lose your input?')) {
                return;
            }

            onDismiss();
        }
    }

    const modalTarget = document.getElementById('modal-target');

    const modalContextValue = useMemo(
        () => ({
            onDismiss: (() => dismissModal(false)) || (() => {}),
        }),
        [onDismiss]
    );

    if (!modalTarget) {
        return null;
    }

    function stop(event: React.SyntheticEvent) {
        event.stopPropagation();
    }

    const sizeClassName = size === 'lg' ? 'modal-wrapper-lg' : size === 'md' ? 'modal-wrapper-md' : '';

    return createPortal(
        <ModalContext.Provider value={modalContextValue}>
            <div className="modal-backdrop" onMouseDown={() => dismissModal(true)}>
                <div className={`modal-wrapper ${sizeClassName} ${className}`} onMouseDown={stop} {...props}>
                    <button onClick={() => dismissModal(false)} className="modal-close">
                        <i className="fas fa-times" />
                    </button>

                    <div className={`modal`}>
                        {title && (
                            <header className="modal-header">
                                <span className="modal-title">{title}</span>
                            </header>
                        )}
                        <div className="modal-content scrollbar">
                            {children && <section className="h-full">{children}</section>}
                        </div>
                    </div>
                </div>
            </div>
        </ModalContext.Provider>,
        modalTarget
    );
}

type ModalButtonsProps = {
    children?: React.ReactNode;
    className?: string;
};

function ModalButtons({ children, className = '' }: ModalButtonsProps) {
    const { onDismiss } = useContext(ModalContext);

    return (
        <div className={`${className}`}>
            <div className="form-buttons-modal gap-4 mt-6 -mb-6 py-3 bg-white border-t-3 border-tint-200">
                {children}
                <button type="button" className="link-dimmed" onClick={onDismiss}>
                    Cancel
                </button>
            </div>
        </div>
    );
}

Modal.Buttons = ModalButtons;
