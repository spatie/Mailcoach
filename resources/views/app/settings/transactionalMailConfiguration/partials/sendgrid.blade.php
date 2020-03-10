<p class="alert alert-info text-sm">
    Learn how to configure Sendgrid by reading <a target="_blank" href="https://mailcoach.app/docs/app/mail-configuration/sendgrid">this section of the
        Mailcoach docs</a>.
</p>

<x-text-field
    label="API key"
    name="sendgrid_api_key"
    type="password"
    :value="$mailConfiguration->sendgrid_api_key"
/>
