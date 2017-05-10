@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-6">
        	@if (session('message'))
                <div class="alert alert-info">
                    {{ session('message') }}
                </div>
            @endif
            <div class="alert alert-info">
            	<fieldset>
				<legend>@lang('auth.Login')</legend>
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

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
                            <div class="col">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('auth.rememberMe')
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <div class="col-12">
                                <button type="submit" class="btn btn-outline-primary btn-block">
                                    @lang('auth.Login')
								</button>
							</div>
							<br>
							<div class="col-12">
								<div class="row">
									<div class="col">
										<a class="btn btn-outline-success btn-block" href="{{ route('register') }}">@lang('auth.Register')</a>
									</div>
									<div class="col">
										<a class="btn btn-outline-secondary btn-block" href="{{ route('password.request') }}">@lang('auth.ForgotPassword')</a>
									</div>
								</div>
							</div>
                        </div>
                        @if(config('customuser.enableSoc') == 1)
                        <hr>
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
                        @endif
                        
                    </form>
				</fieldset>
			</div>
        </div>
    </div>
</div>
@endsection
