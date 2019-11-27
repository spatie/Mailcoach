TODO: add link to docs

<x-text-field label="API key" name="sendgrid_api_key" type="text" :value="$mailConfiguration->sendgrid_api_key"/>
<x-text-field label="Webhook signing secret" name="sendgrid_signing_secret" type="secret"
              :value="$mailConfiguration->sendgrid_signing_secret"/>

You must set a webhook to {{ url(action(\Spatie\MailcoachSendgridFeedback\SendgridWebhookController::class)) . '?secret=YOUR-WEBHOOK-SIGNING-SECRET' }}
