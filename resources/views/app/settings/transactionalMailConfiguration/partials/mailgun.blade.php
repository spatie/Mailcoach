<x-help>
    {!! __('Learn how to configure :provider by reading <a target="_blank" href=":docsLink">this section of the Mailcoach docs</a>.', ['provider' => 'Mailgun', 'docsLink' => 'https://mailcoach.app/docs/v2/app/mail-configuration/mailgun']) !!}
</x-help>

<x-text-field
    :label="__('Domain')"
    name="mailgun_domain"
    type="text"
    :value="$mailConfiguration->mailgun_domain"
/>

<x-text-field
    :label="__('Secret')"
    name="mailgun_secret"
    type="password"
    :value="$mailConfiguration->mailgun_secret"
/>

<x-text-field
    :label="__('Endpoint')"
    name="mailgun_endpoint"
    type="text"
    :value="$mailConfiguration->mailgun_endpoint"
/>
