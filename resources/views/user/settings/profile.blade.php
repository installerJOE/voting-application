@extends('user.layout')

@section('meta-content')
    <title> Profile | {{config('app.name')}} </title>
@endsection

@section('content-header', 'My Profile')

@section('content-body')
<section>
    <div class="profile-summary-block">
        <div class="col-md-3 col-lg-4 col-sm-6 col-6 text-center">
            <img src="{{asset('images/profile_images/' . $profile_image )}}" width="100%" height="auto" id="profile-image" class="profile-pic"/>
            <h1 class="text-blue sub-header" style="margin-top: 5px"> {{Auth::user()->username}}</h1>
            <small class="text-muted">Joined: {{Auth::user()->created_at->format('F Y')}}</small> <br/>

            <div class="form-group" id="profile_image">
                <label for="file_profile_img" class="text-peach link-text"> 
                    Edit Profile Picture 
                </label><br/>
                <input type="file" id="file_profile_img" onchange="showImageCropper(event, '#profile_image', 1)" style="display:none"/>
                <form action="{{route('user.updateProfileImage')}}" method="POST" class="ajax-form">
                    @csrf
                    <input type="hidden" class="base64image" name="profile_image" value="{{old('cover_image')}}" required/>
                </form>
                <input type="hidden" class="ajax-method"/>
            </div>
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

@include('user.modals.update-bio-details')
@include('user.modals.crop-image')
@endsection
