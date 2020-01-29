<h1>Welcome to <a href="{{ config('app.url') }}">{{ config('app.name') }}</a></h1>
<p>
    Dear {{ $user->first_name }},
</p>
<p>
    Your account has been approved. You can now pick a password at our site and login.
</p>
<table>
    <tr>
        <td>
            <p>
                <a href="{{ route('welcome', [$user->id, $token]) }}" class="btn-primary">
                    Pick a password
                </a>
            </p>
        </td>
    </tr>
</table>

<p>
    <em>This link is valid until {{ now()->addMinutes(config('auth.passwords.users.expire'))->format('Y/m/d') }}.</em>
</p>

