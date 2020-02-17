<p class="alert alert-info text-sm">
    Learn how to configure Sendgrid by reading <a target="_blank" href="https://mailcoach.app/docs/app/mail-configuration/sendgrid">this section of the
        Mailcoach docs</a>.
    <br>
    You must set a webhook to
    <code
        class=markup-code>{{ url(action(\Spatie\MailcoachSendgridFeedback\SendgridWebhookController::class)) . '?secret=' . $mailConfiguration->sendgrid_signing_secret }}</code>

</p>

<x-text-field
    label="Mails per second"
    name="sendgrid_mails_per_second"
    type="number"
    :value="$mailConfiguration->sendgrid_mails_per_second"
/>

<x-text-field
    label="API key"
    name="sendgrid_api_key"
    type="password"
    :value="$mailConfiguration->sendgrid_api_key"
/>


<x-text-field
    label="Webhook signing secret"
    name="sendgrid_signing_secret"
    type="text"
    :value="$mailConfiguration->sendgrid_signing_secret"
/>
