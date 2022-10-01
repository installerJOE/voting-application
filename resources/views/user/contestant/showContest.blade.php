@extends('user.layout')

@section('meta-content')
    <title> {{$contestant->contest->name}} | {{config('app.name')}} </title>
    <style>
        .contest-card{
            padding:10px;
        }
        .contest-card img{
            border-radius: 10px
        }
    </style>
@endsection

@section('content-header', 'My Contests')

@section('content-body')
<div class="submenu-less-div-content">
    <div class="col-md-12 text-right">
        <a href="{{route('user.contests')}}" class="btn btn-blue-bd btn-alert-modal" style="float:right"> 
            Back to My Contests
        </a>
    </div>
    <div class="content-sub-header">
        <h1 class="text-blue sub-header">
            {{$contestant->contest->name}}
        </h1>
    </div> 
    <hr class="sub-header-hr"/>

    <div class="mt-2 analytics-block">
        @foreach ($contestant->images as $image)
            <div class="col-md-4 col-sm-6 col-12 contest-card">
                <img src="{{asset('images/contestants/' . $image->image_url)}}" width="100%" height="auto"/>
            </div>
        @endforeach
    </div>
    <div class="mt-2 analytics-block">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 analytics-card">
            <div class="card">
                <p class="text-grey"> My Votes </p>
                <h1 class="sub-header text-blue"> 
                    {{$contestant->number_of_votes}}
                </h1>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12 analytics-card">
            <div class="card">
                <p class="text-grey"> Registration Status </p>
                <h1 class="caption-header text-blue"> 
                    {{$contestant->status}}
                </h1>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12 analytics-card">
            <div class="card">
                <p class="text-grey"> Contestant Number </p>
                <h1 class="caption-header text-blue"> 
                    #{{$contestant->contestant_number}}
                </h1>
            </div>
        </div>
    </div>

    <div class="content-sub-header mt-2">
        <h1 class="text-peach caption-header">
            My Profile Overview
        </h1>
    </div> 
    <hr class="sub-header-hr"/>

    <div class="analytics-block">
        <p> {{$contestant->profile_overview}} </p>
    </div>

    <div class="mt-2">
        <button type="button" class="btn btn-alert-modal btn-peach-bg" data-bs-toggle="modal" data-bs-target="#editContestantProfileModal">
            Edit Profile
        </button>
    </div>
</div>

@include('user.modals.edit-contestant-profile')
@endsection
