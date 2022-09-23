@extends('user.layout')

@section('meta-content')
    <title> Admin Dashboard | {{config('app.name')}} </title>
@endsection

@section('content-header')
    <h1 class="header">
        Dashboard
    </h1>
@endsection

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
                <p class="text-grey"> Total Contests </p>
                <h1 class="sub-header text-blue mt-1"> 
                    {{\App\Models\Contest::all()->count()}}
                </h1>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12 analytics-card">
            <div class="card">
                <p class="text-grey"> Total Contestants </p>
                <h1 class="sub-header text-blue mt-1"> 
                    {{\App\Models\Contestant::all()->count()}}
                </h1>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12 analytics-card">
            <div class="card">
                <p class="text-grey"> Active Contests </p>
                <h1 class="sub-header text-blue mt-1"> 
                    {{\App\Models\Contest::where('vote_end_at', '<', time())->get()->count()}}
                </h1>
            </div>
        </div>
    </div>
</div>
@endsection
