<p class="form-note">
    TODO: add link to Mailgun setup instructions
</p>

<x-text-field label="Domain" name="mailgun_domain" type="text" :value="$mailConfiguration->mailgun_domain"/>
<x-text-field label="Secret" name="mailgun_secret" type="password" :value="$mailConfiguration->mailgun_secret"/>
<x-text-field label="Endpoint" name="mailgun_endpoint" type="text"
                :value="$mailConfiguration->mailgun_endpoint"/>
<x-text-field label="Webhook signing secret" name="mailgun_signing_secret" type="secret"
                :value="$mailConfiguration->mailgun_signing_secret"/>

<p class="form-note">
    You must set a webhook to 
    <code class="markup-code">{{ url(action(\Spatie\MailcoachMailgunFeedback\MailgunWebhookController::class)) }}</code>
</p>