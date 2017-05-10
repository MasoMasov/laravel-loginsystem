@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-md-center">
		<div class="col-6">
			<div class="alert alert-info">
				<fieldset>
				@if(session('message'))
					<div class="alert alert-danger">
						{{ session('message') }}
					</div>
				@endif
				
				<h3>@lang('auth.mustActivate')</h3>
				@lang('auth.checkMailforAct')
				
				<br><br>
					<a href="{{ url('/sendactivationemail') }}" class="btn btn-outline-secondary btn-block">@lang('auth.sendActMail')</a>
				</fieldset>
			</div>
		</div>
	</div>
</div>
@endsection