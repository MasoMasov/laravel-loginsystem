@component('mail::message')
# {{ __('auth.invRegistration') }}

{{ __('auth.invForReg') }} {{ config('app.name') }}.<br>
{{ __('auth.forRegisterPressButton') }}

@component('mail::button', ['url' => $url])
{{ __('auth.buttonInvite') }}
@endcomponent
<br>
{{ __('auth.buttonProblem') }}<br>
{{ $url }}
<hr>
{{ __('auth.thanks') }},<br>
{{ config('app.name') }}
@endcomponent
