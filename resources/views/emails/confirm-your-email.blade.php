@component('mail::message')
# One more step before joining Tutorial !

We need you to confirm your Email

@component('mail::button', ['url' => route('confirm-email') . '?token='. $user->confirm_token])
Confirm Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
