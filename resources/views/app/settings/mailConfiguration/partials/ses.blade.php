<x-help>
    {!! __('Learn how to configure :provider by reading <a target="_blank" href=":docsLink">this section of the Mailcoach docs</a>.', ['provider' => 'SES', 'docsLink' => 'https://mailcoach.app/docs/v2/app/mail-configuration/amazon-ses']) !!}

    <br>

    {!! __('You must set a webhook to: <code class="markup-code">:webhookUrl</code>', ['webhookUrl' => url(action(\Spatie\MailcoachSesFeedback\SesWebhookController::class))]) !!}
</x-help>

<x-text-field
    :label="__('Mails per second')"
    name="ses_mails_per_second"
    type="number"
    :value="$mailConfiguration->ses_mails_per_second"
/>

<x-text-field
    :label="__('Key')"
    name="ses_key"
    type="password"
    :value="$mailConfiguration->ses_key"
/>

<x-text-field
    :label="__('Secret')"
    name="ses_secret"
    type="password"
    :value="$mailConfiguration->ses_secret"
/>

<x-text-field
    :label="__('Region')"
    name="ses_region"
    type="text"
    :value="$mailConfiguration->ses_region"
/>

<x-text-field
    :label="__('Configuration set name')"
    name="ses_configuration_set"
    type="text"
    :value="$mailConfiguration->ses_configuration_set"
/>
