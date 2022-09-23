@extends('user.layout')

@section('meta-content')
    <title> Contests Management | Admin | {{config('app.name')}} </title>
    <style>
        .content-sub-header{
            padding: 1.5em;
            background-color: #f2f2f2;
            border: 0px;
        }
    </style>
@endsection

@section('content-header')
    <h1 class="header">
        Contests Management
    </h1>
@endsection

@section('content-body')
<div class="col-md-12 text-right">
    <a href="{{route('admin.contests')}}" class="btn btn-blue-bd btn-alert-modal" style="float:right"> 
        Back to Contests
    </a>
</div>
<div class="submenu-less-div-content">
    <div class="col-md-12 mt-1 card content-sub-header">
        <h1 class="sub-header text-peach"> 
            Name of Contest
        </h1>
    </div> 

    <div class="col-md-12 mt-2 analytics-block">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 analytics-card">
            <div class="card">
                <p class="text-grey"> Registered Contestants </p>
                <h1 class="sub-header text-blue"> 
                    20
                </h1>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12 analytics-card">
            <div class="card">
                <p class="text-grey"> Total Votes </p>
                <h1 class="sub-header text-blue"> 
                    4032
                </h1>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12 analytics-card">
            <div class="card">
                <p class="text-grey"> Registration Status </p>
                <h1 class="sub-header text-blue"> 
                    Active
                </h1>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12 analytics-card">
            <div class="card">
                <p class="text-grey"> Voting Status </p>
                <h1 class="sub-header text-blue"> 
                    Closed  
                </h1>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12 analytics-card">
            <div class="card">
                <p class="text-grey"> Highest Votes Per Contestant </p>
                <h1 class="sub-header text-blue"> 
                    200
                </h1>
            </div>
        </div>

    </div>

    <div class="col-md-12 mt-3">
        <p>
            <button type="button" class="btn btn-blue-bg btn-alert-modal" data-bs-toggle="modal" data-bs-target="#endContestConfirmModal"> 
                End Contest 
            </button>
        </p>
    </div>
</div>
@endsection
