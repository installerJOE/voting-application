<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Latest compiled and minified CSS and JS for bootstrap 5 and Jquery-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">


        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://kit.fontawesome.com/22b786e40e.js" crossorigin="anonymous"></script>

        <!-- Styles -->
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
        <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
        <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
        <link href="{{ asset('css/contest.css') }}" rel="stylesheet">
        <link href="{{URL::asset('/images/logo-icon.png')}}" type="image/x-icon" rel="shortcut icon"> 
        

        <!--All meta contents of existing page-->
        <!------------------------------------------------------------------------------------------------------>
        @yield('meta-content')
        <!------------------------------------------------------------------------------------------------------>
        
    </head>
    <body>
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <div class="col-md-3 col-xl-2 col-lg-2 col-sm-9 bg-dark sidebar" id="sideBarContent">
                    @include('user.sidebar')
                </div>
                <div class="col-md-9 col-xl-10 col-lg-10 col-sm-12" id="dashboard-content">
                    <div class="col-md-12 col-12 dashboard-header"> 
                        <div class="header-title"> 
                            @yield('content-header')
                        </div>
                        <div class="header-menu-icon"> 
                            <div class="sidebar-toggler" data-bs-target="#sideBarContent" onclick="toggleSideBar()">
                                &#9776;
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-12 content-body">
                        @include('includes.messages')
                        @yield('content-body')
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

        <script>
            function toggleSideBar(){
                var sideBar = document.querySelector('#sideBarContent');
                sideBar.classList.toggle('showSideBar')
            }
        </script>
    </body>
</html>