import React from 'react';
import SentCampaignLayout from 'views/campaigns/layouts/SentCampaignLayout';

type Props = {
    campaign: App.CampaignResource;
    campaign_clicks: Array<App.CampaignClickResource>;
};

export default function Clicks({ campaign, campaign_clicks }: Props) {
    return (
        <SentCampaignLayout campaign={campaign} title="Clicks" activeTab="clicks">
            {campaign.track_clicks && (
                <>
                    {campaign_clicks.map(campaign_click => (
                        <div>
                            <span className="font-bold mr-2">
                                <a target="_blank" href={campaign_click.url}>
                                    {campaign_click.url}
                                </a>
                            </span>
                            <span>{campaign_click.click_count}</span>
                        </div>
                    ))}
                </>
            )}
            {!campaign.track_clicks && <div>Click tracking was not enabled for this campaign.</div>}
        </SentCampaignLayout>
    );
}
