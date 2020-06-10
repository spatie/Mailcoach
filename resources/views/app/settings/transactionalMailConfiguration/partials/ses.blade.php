<x-help>
    {!! __('Learn how to configure :provider by reading <a target="_blank" href=":docsLink">this section of the Mailcoach docs</a>.', ['provider' => 'SES', 'docsLink' => 'https://mailcoach.app/docs/v2/app/mail-configuration/amazon-ses']) !!}
</x-help>

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
