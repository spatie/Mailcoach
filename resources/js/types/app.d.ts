namespace App {
    type UserResource = {
        id: number;
        name: string;
        email: string;
        is_me: boolean;
        links: {
            store: string;
            edit: string;
            delete: string;
        };
    };

    type CampaignResource = {
        id: number;
        name: string;
        from_email: string;
        from_name: string;
        subject: string;
        html: string;
        status: 'created' | 'sending' | 'sent';
        created_at: string;
        sent_at: string;
        sent_to_number_of_subscribers: number;
        track_opens: boolean;
        open_count: number;
        unique_open_count: number;
        open_rate: number;
        track_clicks: boolean;
        click_count: number;
        unique_click_count: number;
        click_rate: number;
        unsubscribe_count: number;
        unsubscribe_rate: number;
        bounce_count: number;
        bounce_rate: number;
        sends_count: number;
        email_list_id: number;
        scheduled_at: string;
        sent_to_all_subscribers: bool;
        list: EmailListResource;
        links: {
            settings: string;
            html: string;
            delivery: string;
            send_test: string;
            schedule: string;
            unschedule: string;
            send: string;
            summary: string;
            opens: string;
            clicks: string;
            unsubscribes: string;
            web_view: string;
            destroy: string;
            duplicate: string;
            actions: string;
        };
    };

    type CampaignSendResource = {
        id: number;
        campaign_name: string;
        opens: number;
        clicks: number;
        sent_at: string;
        first_opened_at: string;
        campaign: CampaignResource;
    };

    type EmailListResource = {
        id: number;
        name: string;
        active_subscription_count: number;
        created_at: string;
        exists: boolean;
        subscribers: Array<SubscriberResource>;
        links: {
            settings: string;
            subscribers: string;
            subscription_flow: string;
            destroy: string;
        };
    };

    type SubscriptionResource = {
        id: number;
        email: string;
        first_name: string;
        last_name: string;
        status: 'pending' | 'subscribed' | 'unsubscribed';
        created_at: string;
        links: {
            show: string;
            edit: string;
        };
    };

    type SubscriberResource = {
        id: number;
        first_name: string;
        last_name: string;
        email: string;
        email_list_ids: Array<number>;
        created_at: string;
        total_campaign_sends_count: number;
        links: {
            create: string;
            edit: string;
            store: string;
            update: string;
            delete: string;
            received_campaigns: string;
        };
    };

    type SubscriberImportResource = {
        id: number;
        imported_subscribers_count: number;
        error_count: number;
        created_at: string;
        status: 'pending' | 'importing' | 'completed';
        email_list: App.EmailListResource;
        import_file_url: string;
        imported_subscribers_report_url: string;
        error_report_url: string;
        links: {
            delete: string;
        };
    };

    export type ResourceCollection<T> = {
        data: Array<T>;
        meta: {
            current_page: number;
            from: number;
            last_page: number;
            per_page: number;
            to: number;
            total: number;
        };
    };

    type CampaignClickResource = {
        url: string;
        click_count: number;
    };

    type CampaignOpenResource = {
        id: number;
        subscriber: SubscriberResource;
        opened_at: string;
    };

    type CampaignUnsubscribeResource = {
        id: number;
        subscriber: SubscriberResource;
        unsubscribed_at: string;
    };

    type TemplateResource = {
        id: number;
        name: string;
        html: string;
        links: {
            create: string;
            store: string;
            edit: string;
            delete: string;
        };
    };

    type Options = Array<{ value: number; label: string }>;
}
