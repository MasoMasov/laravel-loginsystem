
	<div class="navbar navbar-toggleable-md navbar-inverse bg-primary">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="container">
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<a href="../" class="navbar-brand">{{ config('app.name', 'Laravel') }}</a>
				
				@if(Auth::user() && Auth::user()->enabled)
				<ul class="navbar-nav">
					@include('layouts.menuUser')
					
					@if(Auth::user()->class >= config('customuser.setModClass'))
						@include('layouts.menuMod')
					@endif
					
					@if(Auth::user()->class >= config('customuser.setAdminClass'))
						@include('layouts.menuAdmin')
					@endif
				</ul>
				@else
					@include('layouts.menuUnreg')
				@endif
				
				<ul class="nav navbar-nav ml-auto">
					@if(Auth::guest())
						@if(config('customuser.showLoginRegister') == 1)
						<li class="nav-item">
							<a class="nav-link" href="{{ route('login') }}">@lang('auth.Login')</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('register') }}">@lang('auth.Register')</a>
						</li>
						@endif
					@else
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="download">
						&nbsp;&nbsp
						@if(Auth::user()->avatar != '')
							<img src="{{ url(Auth::user()->avatar) }}" width="30" alt="" class="avatar-roudned" >
						@endif
						&nbsp;&nbsp
						@if(Auth::user()->provider == 'github')
							<i class="fa fa-github-square fa-2x"></i>
						@endif
						@if(Auth::user()->provider == 'twitter')
							<i class="fa fa-twitter-square fa-2x"></i>
						@endif
						@if(Auth::user()->provider == 'facebook')
							<i class="fa fa-facebook-square fa-2x"></i>
						@endif
						@if(Auth::user()->provider == 'google')
							<i class="fa fa-google-plus-square fa-2x"></i>
						@endif
						@if(Auth::user()->provider == 'linkedin')
							<i class="fa fa-linkedin-square fa-2x"></i>
						@endif
						{{ Auth::user()->name }} <span class="caret"></span></a>
						<div class="dropdown-menu" aria-labelledby="download">
							<a class="dropdown-item" href="{{ route('auth.usercp') }}">@lang('auth.ControlPannel')</a>
							<div class="dropdown-divider"></div>
							{{ Form::open(['route'=>'logout']) }}
							<button class="dropdown-item">@lang('auth.Logout')</button>
							{{ Form::close() }}
						</div>
					</li>
					@endif
				</ul>
			</div>
		</div>
	</div>