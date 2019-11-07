import React from 'react';
import { render, unmountComponentAtNode } from 'react-dom';
import Modal from '../components/Modal';

type Options = {
    text?: string;
    action?: string;
    buttonClassName?: string;
    onConfirm?: () => void;
};

export default function confirm({
    text = 'Are you sure?',
    buttonClassName,
    action = 'Confirm',
    onConfirm,
}: Options): Promise<boolean> {
    return new Promise<boolean>(resolve => {
        const container = document.createElement('div');

        function resolveConfirmation(confirmed: boolean) {
            unmountComponentAtNode(container);

            resolve(confirmed);

            if (confirmed && onConfirm) {
                onConfirm();
            }
        }

        render(
            <Modal title="Confirm" onDismiss={() => resolveConfirmation(false)}>
                <p className="mb-8">{text}</p>
                <div className="grid cols-auto gap-4 justify-start">
                    <button
                        className={`${buttonClassName ? buttonClassName : 'button'}`}
                        onClick={() => resolveConfirmation(true)}
                    >
                        {action}
                    </button>
                    <button type="button" className="link-dimmed" onClick={() => resolveConfirmation(false)}>
                        Cancel
                    </button>
                </div>
            </Modal>,
            container
        );
    });
}
