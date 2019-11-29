<p class="form-note">
    TODO: add link to docs
</p>

<x-text-field label="API key" name="sendgrid_api_key" type="password" :value="$mailConfiguration->sendgrid_api_key"/>
<x-text-field label="Webhook signing secret" name="sendgrid_signing_secret" type="text"
              :value="$mailConfiguration->sendgrid_signing_secret"/>

<p class="form-note">
You must set a webhook to 
<code class=markup-code>{{ url(action(\Spatie\MailcoachSendgridFeedback\SendgridWebhookController::class)) . '?secret=YOUR-WEBHOOK-SIGNING-SECRET' }}</code>
</p>