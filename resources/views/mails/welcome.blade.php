<h1>{!! __('Welcome to <a href=":appLink">:appName</a>', ['appLink' => config('app.link'), 'appName' => config('app.name')]) !!}</h1>
<p>
    {{ __('Dear :firstName', ['firstName' => $user->first_name]) }},
</p>
<p>
    {{ __('Your account has been approved. You can now pick a password at our site and login.') }}
</p>
<table>
    <tr>
        <td>
            <p>
                <a href="{{ route('welcome', [$user->id, $token]) }}" class="btn-primary">
                    {{ __('Pick a password') }}
                </a>
            </p>
        </td>
    </tr>
</table>

<p>
    <em>
        {{ __('This link is valid until :validUntil', ['validUntil' => now()->addMinutes(config('auth.passwords.users.expire'))->format('Y/m/d')]) }}
    </em>
</p>

