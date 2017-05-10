@component('mail::message')
# {{ __('auth.wellcome') }}, {{ $username }}!

{{ __('auth.successReg') }} {{ config('app.name') }}<br>
{{ __('auth.pressToConfirm') }}<br>

@component('mail::button', ['url' => $link])
{{ __('auth.regConfirm') }}
@endcomponent
<br>
{{ __('auth.buttonProblem') }}<br>
{{ $link }}
<hr>
{{ __('auth.ifNoConfirm') }}
<br>
{{ __('auth.thanks') }},<br>
{{ config('app.name') }}
@endcomponent
