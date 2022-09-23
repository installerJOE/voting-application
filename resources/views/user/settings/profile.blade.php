@extends('user.layout')

@section('meta-content')
    <title> Profile | {{config('app.name')}} </title>
@endsection

@section('content-header')
    <h1 class="header">
        My Profile
    </h1>
@endsection

@section('content-body')
<section>
    <div class="profile-summary-block">
        <div class="col-md-3 col-lg-4 col-sm-6 col-6 text-center">
            {{-- <img src="{{asset('images/profile_images/' . $profile_image )}}" width="100%" height="auto" id="profile-image" class="profile-pic"/> --}}
            <h1 class="text-blue sub-header"> {{Auth::user()->fullname}} {{Auth::user()->lastname}} </h1>
            <small class="text-muted">Joined: {{Auth::user()->created_at->format('F Y')}}</small> <br/>

            <div class="form-group mt-2">
                Edit Profile Picture
                <input type="file" id="profile_pic" placeholder="Update profile"/> 
            </div>
            <form action="{{route('user.updateProfileImage')}}" method="POST" id="update-profile-image">
                @csrf
                <input type="hidden" id="base64image" name="profile_image"/>
            </form>
        </div>

        <div class="col-lg-8 col-md-9 col-sm-12 col-12 profile-basic-data">
            <div class="card peach-bd">
                <p class="text-grey"> Full names </p>
                <h1 class="caption-header text-blue"> 
                    {{(Auth::user()->name)}}
                </h1>
            </div>

            <div class="card grey-bd">
                <p class="text-grey"> 
                    Account Role
                </p>
                <h1 class="caption-header text-blue"> 
                    Contestant
                </h1>
            </div>

            <div class="card grey-bd">
                <p class="text-grey"> 
                    Email
                </p>
                <h1 class="caption-header text-blue"> 
                    {{(Auth::user()->email)}}
                </h1>
            </div>

            <div class="card grey-bd">
                <p class="text-grey"> 
                    Phone Number
                </p>
                <h1 class="caption-header text-blue"> 
                    {{Auth::user()->phone_number ?? "N/A"}}
                </h1>
            </div>
        </div>
    </div>
</section>

<div class="row" style="clear:left;">
    <p class="mt-1">
        <button type="button" class="btn btn-alert-modal btn-blue-bg" data-bs-toggle="modal" data-bs-target="#updateProfileBioDataModal">
            Edit Bio Data
        </button>
    </p>
</div>

<script>
    $(document).ready(function(){
        var $modal = $('#cropImageModal');
        var image = document.getElementById('original_image');
        var cropper;
        
        $("#profile_pic").change(function(e){
            var files = e.target.files;
            var done = function (url) {
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
        });
            
        $modal.on('shown.bs.modal', function () {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 2,
                preview: '.preview',
                zoomOnWheel: true,
                scalable: true,
            });
        }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null;
        });
            
        $("#cropImage").click(function(){
            canvas = cropper.getCroppedCanvas({
                Width: 256,
                Height: 256,
            });
            
            canvas.toBlob(function(blob) {
                // url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob); 
                reader.onloadend = function() {
                    var base64data = reader.result; 
                    $("#base64image").val(base64data);

                    //display image
                    document.getElementById('profile-image').src = base64data;

                    // submit data to the backend
                    document.getElementById('update-profile-image').submit()

                    // close modal and submit form
                    $modal.modal('hide');
                }
            });
        });
    });
</script>
@include('user.modals.update-bio-details')
@include('user.modals.crop-image')
@endsection
