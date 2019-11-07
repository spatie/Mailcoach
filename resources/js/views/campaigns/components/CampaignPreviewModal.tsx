import Frame from 'react-frame-component';
import Modal from 'components/Modal';
import React from 'react';

type Props = {
    html: string;
    onDismiss: () => void;
};

export default function CampaignPreviewModal({ html, onDismiss }: Props) {
    return (
        <Modal onDismiss={onDismiss} size="lg">
            <Frame className="w-full h-full">
                <div dangerouslySetInnerHTML={{ __html: html }} />
            </Frame>
        </Modal>
    );
}
