import React from 'react';
import SentCampaignLayout from 'views/campaigns/layouts/SentCampaignLayout';
import { confirm } from '../../../util/index';
import { Inertia } from '@inertiajs/inertia';

type Props = {
    campaign: App.CampaignResource;
};

export default function Actions({ campaign }: Props) {
    async function handleDelete() {
        confirm({
            action: 'Delete',
            buttonClassName: 'button-delete',
            text: `Are you sure you want to delete ${campaign ? campaign.name : ''}? `,
            onConfirm: () => Inertia.delete(campaign.links.destroy),
        });
    }

    async function handleDuplicate() {
        confirm({
            action: 'Duplicate',
            buttonClassName: 'button-duplicate',
            text: `Are you sure you want to duplicate ${campaign ? campaign.name : ''}? `,
            onConfirm: () => Inertia.post(campaign.links.duplicate),
        });
    }

    return (
        <SentCampaignLayout campaign={campaign} title="Actions" activeTab="actions">
            <div className="buttons">
                <button type="button" className="link-delete" onClick={handleDelete}>
                    Delete
                </button>
                <button type="button" className="link-duplicate" onClick={handleDuplicate}>
                    Duplicate
                </button>
            </div>
        </SentCampaignLayout>
    );
}
