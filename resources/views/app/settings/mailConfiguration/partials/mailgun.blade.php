<x-help>
    Learn how to configure Mailgun by reading <a target="_blank" href="https://mailcoach.app/docs/app/mail-configuration/mailgun">this section of the Mailcoach
        docs</a>.
    <br>
    You must set a webhook to
    <code class="markup-code">{{ url(action(\Spatie\MailcoachMailgunFeedback\MailgunWebhookController::class)) }}</code>
</x-help>


<x-text-field
    label="Mails per second"
    name="mailgun_mails_per_second"
    type="number"
    :value="$mailConfiguration->mailgun_mails_per_second"
/>

<x-text-field
    label="Domain"
    name="mailgun_domain"
    type="text"
    :value="$mailConfiguration->mailgun_domain"
/>

<x-text-field
    label="Secret"
    name="mailgun_secret"
    type="password"
    :value="$mailConfiguration->mailgun_secret"
/>

<x-text-field
    label="Endpoint"
    name="mailgun_endpoint"
    type="text"
    :value="$mailConfiguration->mailgun_endpoint"
/>

<x-text-field
    label="Webhook signing secret"
    name="mailgun_signing_secret"
    type="secret"
    :value="$mailConfiguration->mailgun_signing_secret"
/>
