@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-md-center">
		<div class="col-4">
			<h2>@lang('auth.ControlPannel')</h2>
			@if (session('message'))
				<div class="alert alert-dismissible alert-danger">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					{{ session('message') }}
				</div>
			@endif
			@if(Auth::user()->avatar != '')
				<img src="{{ url(Auth::user()->avatar) }}" class="img-thumbnail" alt="avatar">
			@endif
		</div>
		<div class="col-8">
			<blockquote class="blockquote">
				<h4>@lang('auth.changePassword')</h4>
				@if(Auth::user()->provider == "")
					<p>
					{{ Form::open(['route' => 'auth.changePass', 'class' => 'form-control']) }}
					{{ Form::label('current-password',__('auth.oldPassword')) }}
					@if ($errors->has('current-password'))
						<p class="text-danger">
							<strong>* {{ $errors->first('current-password') }}</strong>
						</p>
					@endif
					{{ Form::password('current-password',['class' => 'form-control']) }}
					{{ Form::label('password',__('auth.newPassword')) }}
					@if ($errors->has('password'))
						<p class="text-danger">
							<strong>* {{ $errors->first('password') }}</strong>
						</p>
					@endif
					{{ Form::password('password',['class' => 'form-control']) }}
					{{ Form::label('password_confirmation',__('auth.newPassword2')) }}
					@if ($errors->has('password_confirmation'))
						<p class="text-danger">
							<strong>* {{ $errors->first('password_confirmation') }}</strong>
						</p>
					@endif
					{{ Form::password('password_confirmation',['class' => 'form-control']) }}
					{{ Form::submit(__('auth.changePassword'),['class'=>'btn btn-primary']) }}
					{{ Form::close() }}
					</p>
				@else
					<h4>{{ __('auth.changePassOnSoc') }} <b>{{ Auth::user()->provider }}</b></h4>
				@endif
			</blockquote>
			<blockquote class="blockquote">
				<h4>@lang('auth.changeAvatar')</h4>
				@if(Auth::user()->provider == "")
					<p>
						{{ Form::open(['route' => 'auth.changeAvatar', 'class' => 'form-control', 'files' => true]) }}
						{{ Form::label('avatar',__('auth.changeAvatar')) }}
						@if ($errors->has('avatar'))
							<p class="text-danger">
								<strong>* {{ $errors->first('avatar') }}</strong>
							</p>
						@endif
						{{ Form::file('avatar',['class' => 'form-control']) }}<br>
						<p class="text-muted">
							{{ __('auth.avatarSize') }}
						</p>
						{{ Form::submit(__('auth.changeAvatar'),['class'=>'btn btn-primary']) }}
						{{ Form::close() }}
					</p>
				@else
					<p>{{ __('auth.changeSocAvatar') }} <b>{{ Auth::user()->provider }}</b></p>
				@endif
			</blockquote>
		</div>
	</div>
</div>
@if(Auth::user()->invites > 0)
	@include('users.user.invites')
@endif
@endsection