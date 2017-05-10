@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-md-center">
		<div class="col-6">
			<div class="alert alert-info">
				<fieldset>
				<legend>@lang('auth.error')</legend>
				@lang('auth.err404')
				</fieldset>
			</div>
		</div>
	</div>
</div>
@endsection