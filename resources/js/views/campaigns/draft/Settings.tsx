import React from 'react';
import { Inertia } from '@inertiajs/inertia';
import { confirm } from '../../../util/index';
import { TextField, CheckboxField, SelectField, useForm } from '../../../forms';
import EditCampaignLayout from 'views/campaigns/layouts/EditCampaignLayout';

type Props = Inertia.PageProps & {
    campaign: App.CampaignResource;
    email_lists: Array<App.EmailListResource>;
};

export default function Form({ campaign, email_lists }: Props) {
    const form = useForm(campaign, campaign.links.settings, 'PUT');

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
        <EditCampaignLayout campaign={campaign} title={`${campaign.name} settings`} activeTab="settings">
            <form className="card-grid" onSubmit={form.submit}>
                <TextField label="Name" {...form.getInputProps('name')} />
                <TextField label="From email" {...form.getInputProps('from_email')} />
                <TextField label="From name" {...form.getInputProps('from_name')} />
                <TextField label="Subject" {...form.getInputProps('subject')} />
                <SelectField
                    label="List"
                    options={email_lists.map(list => {
                        return { value: list.id, label: `${list.name} (${list.active_subscription_count})` };
                    })}
                    {...form.getInputProps('email_list_id')}
                />
                <div className="card-checkboxes">
                    <CheckboxField name="track_opens" label="Track opens" {...form.getInputProps('track_opens')} />
                    <CheckboxField name="track_clicks" label="Track clicks" {...form.getInputProps('track_clicks')} />
                </div>

                <div className="buttons">
                    <button type="submit" className="button">
                        Save
                    </button>
                    <button type="button" className="link-delete" onClick={handleDelete}>
                        Delete
                    </button>
                    <button type="button" className="link-duplicate" onClick={handleDuplicate}>
                        Duplicate
                    </button>
                </div>
            </form>
        </EditCampaignLayout>
    );
}
