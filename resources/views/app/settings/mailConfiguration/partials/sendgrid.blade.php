<p class="alert alert-info text-sm">
    TODO: add link to docs
    <br>
    You must set a webhook to
<code class=markup-code>{{ url(action(\Spatie\MailcoachSendgridFeedback\SendgridWebhookController::class)) . '?secret=YOUR-WEBHOOK-SIGNING-SECRET' }}</code>

</p>

<x-text-field label="Mails per second" name="sendgrid_mails_per_second" type="number" :value="$mailConfiguration->sendgrid_mails_per_second"/>
<x-text-field label="API key" name="sendgrid_api_key" type="password" :value="$mailConfiguration->sendgrid_api_key"/>
<x-text-field label="Webhook signing secret" name="sendgrid_signing_secret" type="text"
              :value="$mailConfiguration->sendgrid_signing_secret"/>
