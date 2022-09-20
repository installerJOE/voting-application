@extends('layouts.app')

@section('meta-content')
	<title> About Us | {{config('app.name')}} </title>
    <style>
        #about-opening-div{
            background-image: url('../images/contest.jpg');
        }
        .opening-page-div{
            background-color: rgba(0,0,0,0.55)
        }
    </style>  

@endsection

@section('content')
<div class="parent-opening-div">
    <div class="row image-zoom-div" id="about-opening-div">   
    </div>
    <div class="row opening-page-div">
        <div class="col-md-8 col-sm-9 col-12 text-center" style="float: none; margin:auto">
            <h1 class="text-blue xxl-header" style="line-height: 1.2em"> 
                We are a Voting Service for your Contests
            </h1>
        </div>
    </div>
</div>
@endsection