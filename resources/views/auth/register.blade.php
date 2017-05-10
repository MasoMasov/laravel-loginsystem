@extends('layouts.app')

@section('content')
@if(config('customuser.enableRegistration') == 1)

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-6">
            <div class="alert alert-info">
            	<fieldset>
                <legend>@lang('auth.Register')</legend>
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">@lang('auth.Name')</label>

                            <div class="col">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label for="password" class="col-md-4 control-label">@lang('auth.password')</label>

                            <div class="col">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">@lang('auth.confPassword')</label>

                            <div class="col">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
							<label for="recaptcha" class="col-md-4 control-label">reCaptcha</label>
							<div class="col">
								<div class="g-recaptcha" data-sitekey="{{env('RE_CAP_SITE')}}"></div>
								<script src='https://www.google.com/recaptcha/api.js'></script>
							</div>
						</div>

                        <div class="form-group">
                            <div class="col">
                                <button type="submit" class="btn btn-primary btn-block">
                                    @lang('auth.Register')
                                </button>
                            </div>
                        </div>
                        @if(config('customuser.enableSoc') == 1)
                        <hr>
						<div class="form-group">
							<div class="form-group text-center">
								<div class="col-12">
									<h4>@lang('auth.socLogin')</h4>
									@if(config('customuser.enableSocGH') == 1)
										<a href="{{ url('/auth/github') }}" class="btn github waves-effect waves-light"><i class="fa fa-github-square fa-2x"></i></a>
									@endif
									@if(config('customuser.enableSocTW') == 1)
										<a href="{{ url('/auth/twitter') }}" class="btn twitter"><i class="fa fa-twitter-square fa-2x"></i></a>
									@endif
									@if(config('customuser.enableSocFB') == 1)
										<a href="{{ url('/auth/facebook') }}" class="btn facebook"><i class="fa fa-facebook-square fa-2x"></i></a>
									@endif
									@if(config('customuser.enableSocGO') == 1)
										<a href="{{ url('/auth/google') }}" class="btn google"><i class="fa fa-google-plus-square fa-2x"></i></a>
									@endif
									@if(config('customuser.enableSocLI') == 1)
										<a href="{{ url('/auth/linkedin') }}" class="btn linkedin"><i class="fa fa-linkedin-square fa-2x"></i></a>
									@endif
								</div>
							</div>
						</div>
                        @endif
                    </form>
                </fieldset>
            </div>
        </div>
    </div>
</div>

@else
	<div class="container">
    	<div class="row justify-content-md-center">
    		<div class="alert alert-info">
			@if(config('customuser.enableRegistration') == 0)
				<h2>@lang('auth.RegStoped')</h2>
			@endif
			
			@if(config('customuser.enableRegistration') == 2)
				<h2>@lang('auth.RegInv')</h2>
			@endif
			</div>	
		</div>
	</div>

@endif
@endsection
