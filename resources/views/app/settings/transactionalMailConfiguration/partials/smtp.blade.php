<x-text-field label="Host" name="smtp_host" type="text" :value="$mailConfiguration->smtp_host"/>
<x-text-field label="Port" name="smtp_port" type="number" :value="$mailConfiguration->smtp_port"/>
<x-text-field label="Username" name="smtp_username" type="text"
                :value="$mailConfiguration->smtp_username"/>
<x-text-field label="Password" name="smtp_password" type="password"
                :value="$mailConfiguration->smtp_password"/>
