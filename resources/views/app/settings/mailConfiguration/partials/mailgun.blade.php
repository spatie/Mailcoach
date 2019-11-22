<form
    class="card-grid"
    action="{{ route('mailConfiguration') }}"
    method="POST"
>
    @csrf
    @method('PUT')

    <input type="hidden" name="mail_driver" name="mailgun" />
    <x-text-field label="Domain" name="mailgun_domain" type="text" :value="$mailConfiguration->mailgun_domain"/>
    <x-text-field label="Secret" name="mailgun_secret" type="password" :value="$mailConfiguration->mailgun_secret"/>
    <x-text-field label="Endpoint" name="mailgun_endpoint" type="text"
                  :value="$mailConfiguration->mailgun_endpoint"/>
    <x-text-field label="Webhook signing secret" name="mailgun_signing_secret" type="secret"
                  :value="$mailConfiguration->mailgun_signing_secret"/>

    <button type="submit" class="button">
        Save
    </button>
</form>
