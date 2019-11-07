import React, { useState } from 'react';
import { useForm } from '../../../forms';
import EditCampaignLayout from 'views/campaigns/layouts/EditCampaignLayout';
import { Controlled as CodeMirror } from 'react-codemirror2';
import CampaignPreviewModal from 'views/campaigns/components/CampaignPreviewModal';
require('codemirror/mode/xml/xml');

type Props = Inertia.PageProps & {
    campaign: App.CampaignResource;
};

export default function Html({ campaign }: Props) {
    const form = useForm(campaign, campaign.links.html, 'PUT');

    const [previewHtml, setPreviewHtml] = useState(form.getInputProps('html').value);
    const [modalOpen, setModalOpen] = useState<boolean>(false);

    function handleChange(html: string) {
        form.getInputProps('html').onChange(html);
        setPreviewHtml(html);
    }

    return (
        <EditCampaignLayout campaign={campaign} title={`${campaign.name} HTML`} activeTab="html">
            <form className="card-grid" onSubmit={form.submit}>
                <div className="form-textarea max-w-full overflow-x-auto p-0">
                    <CodeMirror
                        value={form.getInputProps('html').value}
                        options={{
                            mode: 'xml',
                            indentUnit: 4,
                        }}
                        onBeforeChange={(_editor, _data, value) => handleChange(value)}
                    />
                </div>

                <div className="buttons">
                    <button type="submit" className="button">
                        Save
                    </button>
                    <button type="button" className="link-dimmed" onClick={() => setModalOpen(true)}>
                        Preview
                        <i className="far fa-eye ml-1" />
                    </button>
                </div>

                {modalOpen && <CampaignPreviewModal html={previewHtml} onDismiss={() => setModalOpen(false)} />}
            </form>
        </EditCampaignLayout>
    );
}
