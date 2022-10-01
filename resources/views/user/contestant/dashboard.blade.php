@extends('user.layout')

@section('meta-content')
    <title> Dashboard | Contestant | {{config('app.name')}} </title>
@endsection

@section('content-header', 'Dashboard')

@section('content-body')
<div class="submenu-less-div-content">
    <div class="content-sub-header">
        <h1 class="sub-header">
            Overview
        </h1>
    </div> 
    <hr class="sub-header-hr"/>

    <div class="mt-2 analytics-block">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 analytics-card">
            <div class="card">
                <p class="text-grey"> My Active Contests </p>
                <h1 class="sub-header text-blue"> 
                    {{Auth::user()->contestants()->where('status', 'active')->get()->count()}}
                </h1>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12 analytics-card">
            <div class="card">
                <p class="text-grey"> Pending Contest Requests </p>
                <h1 class="sub-header text-blue"> 
                    {{Auth::user()->contestants()->where('status', 'requested')->get()->count()}}
                </h1>
            </div>
        </div>
    </div>
</div>
@endsection
