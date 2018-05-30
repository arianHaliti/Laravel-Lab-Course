<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lab 2') }}</title>

<!-- MetisMenu CSS -->
<link href="{{ asset('css/metisMenu.min.css') }}" rel="stylesheet">

<!-- Custom CSS -->
<link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">

<!-- Morris Charts CSS -->
<link href="{{ asset('css/morris.css') }}" rel="stylesheet">


    <!-- Scripts -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}" ></script>
    
    
	
	 <!-- Metis Menu Plugin JavaScript -->
     <script src="{{ asset('js/metisMenu.min.js') }}"></script>

<!-- Morris Charts JavaScript -->
<script src="{{ asset('js/raphael.min.js') }}"></script>
<script src="{{ asset('js/morris.min.js') }}"></script>
<script src="{{ asset('js/morris-data.js') }}"></script>

<!-- Custom Theme JavaScript -->
<script src="{{ asset('js/sb-admin-2.js')}}"></script>

    <script  src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery.min.js') }}" ></script>
    <script src ="{{asset('js/jquery.validate.min.js')}}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel = "stylesheet" href="{{asset('css/style.css')}}">
    
    <!-- Styles -->
</head>
<body>


    
    @include('inc.navbar')
    <div class="container">
        @include('inc.messages')
        @yield('content')
    </div>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
       
</body>
</html>
