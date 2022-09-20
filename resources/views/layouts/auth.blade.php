<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Latest compiled and minified CSS and JS for bootstrap 5 and Jquery-->
    
    <!----------------------------------------------------------------------------------------------------->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>

    <!------------------------------------------------------------------------------------------------------>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Fonts -->
    <!------------------------------------------------------------------------------------------------------>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100&display=swap" rel="stylesheet">
    
    <!------------------------------------------------------------------------------------------------------>
    <script src="https://kit.fontawesome.com/22b786e40e.js" crossorigin="anonymous"></script>
    <!------------------------------------------------------------------------------------------------------>

    <!-- Styles -->
    <!------------------------------------------------------------------------------------------------------>
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
    <link href="{{URL::asset('/images/logo-icon.png')}}" type="image/x-icon" rel="shortcut icon"> 

     <!--All meta contents of existing page-->
    <!------------------------------------------------------------------------------------------------------>
    @yield('meta-content')
    <!------------------------------------------------------------------------------------------------------>

    <style>
        
    </style>
</head>
<body>
    <div id="app">
        <div class="col-md-8 col-sm-12 col-12 margin-auto py-5">
            <div class="text-center mb-4">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- <img src="{{asset('images/logo.png')}}" width="auto" height="50px"/> --}}
                    {{ config('app.name', 'MyVotingApp') }}
                </a>
            </div>
            @include('includes.messages')
            <div class="col-md-8 col-lg-8 col-sm-10 col-12 margin-auto auth-content">
                <h1 class="text-center text-peach caption-header">
                    @yield('auth-title')
                </h1>
                <div class="mt-1">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    
    @if($errors->any() || session('info') || session('error') || session('success'))
        <script>
            $(document).ready(function(){
                $('#alertModal').modal('show');
            })
        </script>
    @endif
</body>
</html>
