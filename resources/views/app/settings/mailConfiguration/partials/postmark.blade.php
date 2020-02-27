<p class="alert alert-info text-sm max-w-lg">
    Learn how to configure Postmark by reading <a target="_blank" href="https://mailcoach.app/docs/app/mail-configuration/postmark">this section of the Mailcoach
        docs</a>.
    <br><br />
    You must set a webhook to
    <code class="markup-code">{{ url(action(\Spatie\MailcoachPostmarkFeedback\PostmarkWebhookController::class)) }}</code>. You should set a header <code class="markup-code">mailcoach-signature</code> with the signing secret you specify in the form below.
</p>


<x-text-field
    label="Mails per second"
    name="postmark_mails_per_second"
    type="number"
    :value="$mailConfiguration->postmark_mails_per_second"
/>

<x-text-field
    label="Server Token"
    name="postmark_token"
    type="password"
    :value="$mailConfiguration->postmark_token"
/>

<x-text-field
    label="Signing secret"
    name="postmark_signing_secret"
    type="password"
    :value="$mailConfiguration->postmark_signing_secret"
/>
