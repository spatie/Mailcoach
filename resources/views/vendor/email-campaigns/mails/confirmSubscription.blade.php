@component('mail::message')
Hi,

You are almost subscribed to the {{ $subscription->emailList->name }} email list.

Please confirm by pressing the button below.

@component('mail::button', ['url' => $confirmationUrl])
    Confirm subscription
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
