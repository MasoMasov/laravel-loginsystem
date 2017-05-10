<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}
    	@if(isset($title) && $title != '')
    		 - {{ $title }}
    	@endif	
    </title>

    <!-- Styles -->
    <script src="https://use.fontawesome.com/77c9da045c.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Arimo&subset=latin,cyrillic" rel="stylesheet" type="text/css">
    <link href="{{ url('/css/bootstrap_cosmo.css') }}" rel="stylesheet">
    <link href="{{ url('/css/custom.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
	
		@include('layouts.menu')
		<div style="min-height: 50px;"></div>
	<div class="container">
		<div class="row">
	
		@yield('content')
		</div>
	</div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <script src="{{ url('/js/jquery.min.js') }}"></script>
    <script src="{{ url('/js/app.js') }}"></script>
</body>
</html>
