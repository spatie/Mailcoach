<p class="alert alert-info text-sm max-w-lg">
    Learn how to configure Postmark by reading <a target="_blank" href="https://mailcoach.app/docs/app/mail-configuration/postmark">this section of the Mailcoach
        docs</a>.
    <br><br />
</p>

<x-text-field
    label="Server Token"
    name="postmark_token"
    type="password"
    :value="$mailConfiguration->postmark_token"
/>