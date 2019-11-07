import React, { useState } from 'react';
import { TextField, useForm, DateField } from '../../../forms';
import { confirm } from '../../../util/index';
import Toggle from '../../../components/Toggle';
import EditCampaignLayout from 'views/campaigns/layouts/EditCampaignLayout';
import CampaignPreviewModal from 'views/campaigns/components/CampaignPreviewModal';
import { InertiaLink } from '@inertiajs/inertia-react';

type Props = Inertia.PageProps & {
    campaign: App.CampaignResource;
};

const readyTitles = [
    'My time to shine!',
    'No more time to waste…',
    'Last part: deliver the thing!',
    'Ready to handle the compliments?',
    "Let's make some impact!",
    "Allright, let's do this!",
    'Everyone is sooo ready for this!',
    'Inboxes will be surprised…',
];
const readyTitle = readyTitles[Math.floor(Math.random() * readyTitles.length)];

export default function Form({ campaign }: Props) {
    const [scheduleUI, setScheduleUI] = useState<boolean>(campaign.scheduled_at ? true : false);

    const sendTestForm = useForm({ emails: '' }, campaign.links.send_test, 'POST');
    const scheduleForm = useForm({ scheduled_at: campaign.scheduled_at }, campaign.links.schedule, 'POST');
    const unscheduleForm = useForm({}, campaign.links.unschedule, 'POST');
    const sendForm = useForm(campaign, campaign.links.send, 'POST');

    const [modalOpen, setModalOpen] = useState<boolean>(false);

    function campaignHasHtml() {
        return campaign.html && campaign.html !== '';
    }

    function campaignHasFromEmail() {
        return (campaign.from_email || '') !== '';
    }

    function campaignHasSubject() {
        return campaign.subject && campaign.subject !== '';
    }

    function campaignHasSubscribers() {
        return campaign.list && campaign.list.active_subscription_count > 0;
    }

    function campaignIsReady() {
        return campaignHasFromEmail() && campaignHasHtml() && campaignHasSubject() && campaignHasSubscribers();
    }

    async function handleSendNow() {
        confirm({
            action: 'Send',
            buttonClassName: 'button bg-green-500 hover:bg-green-600 focus:bg-green-600',
            text: `Are you sure you want to send ${campaign.name} now?`,
            onConfirm: () => sendForm.submit(),
        });
    }

    return (
        <EditCampaignLayout campaign={campaign} title={`${campaign.name} delivery`} activeTab="delivery">
            {modalOpen && <CampaignPreviewModal html={campaign.html} onDismiss={() => setModalOpen(false)} />}

            <form className="card-grid items-start cols-auto gap-2" onSubmit={sendTestForm.submit}>
                <TextField
                    {...sendTestForm.getInputProps('emails')}
                    name="emails"
                    placeholder="Enter a comma-separated list of emails"
                    className="max-w-2xl"
                />

                <div className="buttons">
                    <button type="submit" className="button-secondary">
                        Send test email
                    </button>
                </div>
            </form>

            <section>
                {campaignIsReady() ? (
                    <>
                        <h1 className="markup-h1">{readyTitle}</h1>
                        <p className="mt-4">
                            Campaign <strong>{campaign.name}</strong> is ready to be sent.
                        </p>
                    </>
                ) : (
                    <>
                        <h1 className="markup-h1">Almost there…</h1>
                        <p className="mt-4">You need to check some settings before you can deliver this campaign.</p>
                    </>
                )}

                <dl
                    className="mt-4 grid justify-start gapx-6 gapy-2"
                    style={{ gridTemplateColumns: 'repeat(3, auto)' }}
                >
                    <dt className="start-1 text-gray-500">
                        {campaignHasFromEmail() ? (
                            <i className="far fa-check text-green-400 mr-2" />
                        ) : (
                            <i className="far fa-times text-red-400 mr-2" />
                        )}
                        From:
                    </dt>
                    {campaignHasFromEmail() ? (
                        <>
                            {campaign.from_email} {campaign.from_name ? `(${campaign.from_name})` : ''}
                        </>
                    ) : (
                        <>
                            <dd>No from e-mail set</dd>
                            <InertiaLink href={campaign.links.settings} className="link-dimmed">
                                Settings
                            </InertiaLink>
                        </>
                    )}

                    <dt className="start-1 text-gray-500">
                        {campaignHasSubscribers() ? (
                            <i className="far fa-check text-green-400 mr-2" />
                        ) : (
                            <i className="far fa-times text-red-400 mr-2" />
                        )}
                        To:
                    </dt>
                    {campaignHasSubscribers() ? (
                        <dd>
                            {campaign.list.name}
                            {' — '}
                            <strong>{campaign.list.active_subscription_count}</strong> subscriber
                            {campaign.list.active_subscription_count !== 1 && 's'}
                        </dd>
                    ) : (
                        <>
                            <dd>No list selected</dd>
                            <InertiaLink href={campaign.links.settings} className="link-dimmed">
                                Settings
                            </InertiaLink>
                        </>
                    )}

                    <dt className="start-1 text-gray-500">
                        {campaignHasSubject() ? (
                            <i className="far fa-check text-green-400 mr-2" />
                        ) : (
                            <i className="far fa-times text-red-400 mr-2" />
                        )}
                        Subject:
                    </dt>
                    {campaignHasSubject() ? (
                        <dd>{campaign.subject}</dd>
                    ) : (
                        <>
                            <dd>Subject is empty</dd>
                            <InertiaLink href={campaign.links.settings} className="link-dimmed">
                                Settings
                            </InertiaLink>
                        </>
                    )}

                    <dt className="start-1 text-gray-500">
                        {campaignHasHtml() ? (
                            <i className="far fa-check text-green-400 mr-2" />
                        ) : (
                            <i className="far fa-times text-red-400 mr-2" />
                        )}
                        Body:
                    </dt>
                    {campaignHasHtml() ? (
                        <dd>
                            <button type="button" className="link-dimmed" onClick={() => setModalOpen(true)}>
                                Preview
                                <i className="far fa-eye ml-1" />
                            </button>
                        </dd>
                    ) : (
                        <>
                            <dd>HTML is missing</dd>
                            <InertiaLink href={campaign.links.html} className="link-dimmed">
                                Edit
                            </InertiaLink>
                        </>
                    )}
                </dl>
            </section>

            {campaignIsReady() && (
                <>
                    <Toggle
                        on={scheduleUI}
                        onClick={() => setScheduleUI(!scheduleUI)}
                        label="Schedule for delivery in the future?"
                    />

                    {scheduleUI && (
                        <>
                            {campaign.scheduled_at ? (
                                <form className="card-grid" onSubmit={unscheduleForm.submit}>
                                    <p>
                                        <i className="far fa-clock text-yellow-500 mr-1" />
                                        This campaign has been scheduled to be sent at {campaign.scheduled_at}
                                    </p>
                                    <div className="buttons">
                                        <button type="submit" className="link-delete">
                                            Unschedule
                                        </button>
                                    </div>
                                </form>
                            ) : (
                                <>
                                    <form className="" onSubmit={scheduleForm.submit}>
                                        <DateField
                                            {...scheduleForm.getInputProps('scheduled_at')}
                                            name="scheduled_at"
                                        />
                                        <div className="mt-2 buttons">
                                            <button type="submit" className="button">
                                                <i className="far fa-clock mr-1" /> Schedule delivery
                                            </button>
                                        </div>
                                    </form>
                                </>
                            )}
                        </>
                    )}

                    {!scheduleUI && (
                        <div className="buttons">
                            <button
                                onClick={handleSendNow}
                                type="submit"
                                className="button bg-green-500 hover:bg-green-600 focus:bg-green-600"
                            >
                                <i className="far fa-bolt mr-1" /> Send now
                            </button>
                        </div>
                    )}
                </>
            )}
        </EditCampaignLayout>
    );
}
