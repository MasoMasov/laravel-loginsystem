@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-6">
            <div class="alert alert-info">
            	<fieldset>
				<legend>@lang('auth.passReset')</legend>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

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
                        
                        <div class="form-group">
							<label for="recaptcha" class="col control-label">reCaptcha</label>
							<div class="col">
								<div class="g-recaptcha" data-sitekey="{{env('RE_CAP_SITE')}}"></div>
								<script src='https://www.google.com/recaptcha/api.js'></script>
							</div>
						</div>
					
                        <div class="form-group">
                            <div class="col">
                                <button type="submit" class="btn btn-primary btn-block">
                                    @lang('auth.passReset')
                                </button>
                            </div>
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>
    </div>
</div>
@endsection
