<p class="alert alert-info text-sm">
    Open and click tracking is not available for the SMTP driver.
</p>

<x-text-field label="Mails per second" name="smtp_mails_per_second" type="text" :value="$mailConfiguration->smtp_mails_per_second"/>
<x-text-field label="Host" name="smtp_host" type="text" :value="$mailConfiguration->smtp_host"/>
<x-text-field label="Port" name="smtp_port" type="text" :value="$mailConfiguration->smtp_port"/>
<x-text-field label="Username" name="smtp_username" type="text"
                :value="$mailConfiguration->smtp_username"/>
<x-text-field label="Password" name="smtp_password" type="password"
                :value="$mailConfiguration->smtp_password"/>
