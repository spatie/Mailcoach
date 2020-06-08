<x-help>
    {!! __('Learn how to configure :provider by reading <a target="_blank" href=":docsLink">this section of the Mailcoach docs</a>.', ['provider' => 'Postmark', 'docsLink' => 'https://mailcoach.app/docs/v2/app/mail-configuration/postmark']) !!}

    <br>

    {!! __('You must set a webhook to: <code class="markup-code">:webhookUrl</code>', ['webhookUrl' => url(action(\Spatie\MailcoachPostmarkFeedback\PostmarkWebhookController::class))]) !!}

    <br>

    {!! __('You should set a header <code class="markup-code">:header</code> with the signing secret you specify in the form below.', ['header' => 'mailcoach-signature']) !!}
</x-help>


<x-text-field
    :label="__('Mails per second')"
    name="postmark_mails_per_second"
    type="number"
    :value="$mailConfiguration->postmark_mails_per_second"
/>

<x-text-field
    :label="__('Server Token')"
    name="postmark_token"
    type="password"
    :value="$mailConfiguration->postmark_token"
/>

<x-text-field
    :label="__('Signing secret')"
    name="postmark_signing_secret"
    type="password"
    :value="$mailConfiguration->postmark_signing_secret"
/>
