TODO: add link to docs

<x-text-field label="Host" name="sendgrid_host" type="text" :value="$mailConfiguration->sendgrid_host"/>
<x-text-field label="Port" name="sendgrid_port" type="text" :value="$mailConfiguration->sendgrid_port"/>
<x-text-field label="Username" name="sendgrid_username" type="text"
                :value="$mailConfiguration->sendgrid_username"/>
<x-text-field label="Password" name="sendgrid_password" type="password"
                :value="$mailConfiguration->sendgrid_password"/>
<x-text-field label="Webhook signing secret" name="sendgrid_signing_secret" type="secret"
              :value="$mailConfiguration->sendgrid_signing_secret"/>

You must set a webhook to {{ url(action(\Spatie\MailcoachSendgridFeedback\SendgridWebhookController::class)) . '?secret=YOUR-WEBHOOK-SIGNING-SECRET' }}
