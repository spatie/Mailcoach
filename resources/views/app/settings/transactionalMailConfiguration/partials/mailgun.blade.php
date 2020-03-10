<p class="alert alert-info text-sm">
    Learn how to configure Mailgun by reading <a target="_blank" href="https://mailcoach.app/docs/app/mail-configuration/mailgun">this section of the Mailcoach
        docs</a>.
    <br>
</p>

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
