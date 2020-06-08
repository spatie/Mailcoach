<x-help>
    {!! __('Learn how to configure :provider by reading <a target="_blank" href=":docsLink">this section of the Mailcoach docs</a>.', ['provider' => 'Postmark', 'docsLink' => 'https://mailcoach.app/docs/v2/app/mail-configuration/postmark']) !!}
</x-help>

<x-text-field
    :label="__('Server Token')"
    name="postmark_token"
    type="password"
    :value="$mailConfiguration->postmark_token"
/>
