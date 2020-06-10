<x-help>
    {!! __('Learn how to configure :provider by reading <a target="_blank" href=":docsLink">this section of the Mailcoach docs</a>.', ['provider' => 'SendGrid', 'docsLink' => 'https://mailcoach.app/docs/v2/app/mail-configuration/sendgrid']) !!}
</x-help>

<x-text-field
    :label="__('API key')"
    name="sendgrid_api_key"
    type="password"
    :value="$mailConfiguration->sendgrid_api_key"
/>
