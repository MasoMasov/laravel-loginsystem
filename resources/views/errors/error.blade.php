@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-6">
            <div class="alert alert-info">
	            @if (session('message') && session('soc'))
	                <div class="alert alert-danger">
	                    {{ session('message') }} {{ session('soc') }} 
	                </div>
	                <div class="form-group text-center">
						<div class="col-12">
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
	        </div>
        </div>
    </div>
</div>
@endsection