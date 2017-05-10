@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-6">
            <div class="alert alert-info">
	            @if (session('message'))
	                <div class="alert alert-danger">
	                    {{ session('message') }}
	                </div>
	            @endif
	            {{ Form::open(['url'=>'/sendactivationemail','method'=>'POST']) }}
	            {{ Form::label('emailaddress', 'E-Mail адрес') }}
	            {{ Form::email('emailaddress', null,['class' => 'form-control','placeholder'=>'you_email@gmail.com','required']) }}
	            <div class="g-recaptcha" style="margin-top: 5px" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
	            {{ Form::submit(__('auth.Send'),['class' => 'btn btn-outline-primary btn-block','style'=>'margin-top: 5px']) }}
	            <script src='https://www.google.com/recaptcha/api.js'></script>
	            {{ Form::close() }}
	        </div>
        </div>
    </div>
</div>
@endsection