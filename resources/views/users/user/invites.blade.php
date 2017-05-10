<div class="container">
	<div class="row justify-content-md-center">
		<div class="col-4">
			<h2>@lang('auth.Invites')</h2>
			@if (session('message'))
				<div class="alert alert-dismissible alert-danger">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					{{ session('message') }}
				</div>
			@endif
		</div>
		<div class="col-8">
			<blockquote class="blockquote">
				<p>@lang('auth.sentInvite') ( {{ Auth::user()->invites }} @lang('auth.left') )
					{{ Form::open(['route' => 'auth.sentInvite', 'class' => 'form-control']) }}
					{{ Form::label('email',__('auth.sentToEmail')) }}
					@if($errors->has('email'))
						<p class="text-danger">
							<strong>* {{ $errors->first('email') }}</strong>
						</p>
					@endif
					{{ Form::text('email',null,['class' => 'form-control']) }}
					{{ Form::submit(__('auth.sentInvite'),['class'=>'btn btn-primary']) }}
					{{ Form::close() }}
				</p>
			</blockquote>
		</div>
	</div>
</div>