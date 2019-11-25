<form
    class="card-grid"
    action="{{ route('mailConfiguration') }}"
    method="POST"
>
    @csrf
    @method('PUT')

    <input type="hidden" name="driver" name="mailgun" />
    <x-text-field label="Domain" name="domain" type="text" :value="$mailConfiguration->domain"/>
    <x-text-field label="Secret" name="secret" type="password" :value="$mailConfiguration->secret"/>
    <x-text-field label="Endpoint" name="endpoint" type="text"
                  :value="$mailConfiguration->endpoint"/>
    <x-text-field label="Webhook signing secret" name="signing_secret" type="secret"
                  :value="$mailConfiguration->signing_secret"/>

    <br />
    You must set a webhook to {{ url(action(\Spatie\MailcoachMailgunFeedback\MailgunWebhookController::class)) }}

    <button type="submit" class="button">
        Save
    </button>
</form>
