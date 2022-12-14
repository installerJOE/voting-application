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
                            <h1 class="header">
                                @yield('content-header')
                            </h1>
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

            function submitModalForm(formId){
                document.getElementById(formId).submit();
            }
            
            // var imageToDisplay; 
            var imageDivBlock;
            var base64IimageInput;
            var $modal; 
            var cropper;

            function showImageCropper(e, imageBlock, imageRatio){
                var image = document.getElementById('original_image');
                $modal = $('#cropImageModal');
                e = e || window.event;
                
                var files = e.target.files;
                var done = url => {
                    image.src = url;
                    $modal.modal('show');
                };
            
                var reader; var file; var url;
                if (files && files.length > 0) {
                    file = files[0];
                    if (URL) {
                        done(URL.createObjectURL(file));
                    } 
                    else if (FileReader) {
                        reader = new FileReader();
                        reader.onload = function (e) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }
                imageDivBlock = imageBlock;

                $modal.on('shown.bs.modal', function () {
                    if(cropper != null){
                        cropper.destroy();
                        cropper = null; 
                    }
                    cropper = new Cropper(image, {
                        aspectRatio: imageRatio,
                        viewMode: 2,
                        preview: '.preview',
                        zoomOnWheel: true,
                        scalable: true,
                    });
                    console.log(cropper)
                }).on('hidden.bs.modal', function () {
                    cropper.destroy();
                    cropper = null;
                });
            }    
        
            function closeImageCropperModal(){
                let canvas = cropper.getCroppedCanvas({
                    Width: 256,
                    Height: 256,
                });
                console.log(canvas)
                canvas.toBlob(function(blob) {
                    var reader = new FileReader();
                    reader.readAsDataURL(blob); 
                    reader.onloadend = function() {
                        var base64data = reader.result; 
                        
                        // assign image value to form input
                        $(imageDivBlock + " .base64image").val(base64data);
            
                        let ajaxInput = document.querySelectorAll(imageDivBlock + ' .ajax-method');
                        
                        if(ajaxInput.length > 0){
                            document.querySelectorAll(imageDivBlock + ' .ajax-form')[0].submit();
                        }
                        else{
                            //display image on the frontend
                            document.querySelector(imageDivBlock + ' > .image-container').style.display = "block"
                            document.querySelector(imageDivBlock + ' > .image-container > img').src = base64data;
                        }
                        // close modal and submit form
                        $modal.modal('hide');
                    }
                });
            }
        </script>

        @include('user.modals.crop-image')

    </body>
</html>