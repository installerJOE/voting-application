@extends('layouts.app')

@section('meta-content')
	<title> Contact Us | {{config('app.name')}} </title>
    <style>
        #contact-opening-div{
            background-image: url('{{asset("images/index-1.jpg")}}')
        }
        .opening-page-div{
            background-color: rgba(0,0,0,0.55)
        }
    </style>
@endsection

@section('content')
<div class="parent-opening-div">
    <div class="row image-zoom-div" id="contact-opening-div">   
    </div>
    <div class="row opening-page-div">
        <div class="col-md-8 col-sm-9 col-12 text-center" style="float: none; margin:auto">
            <h1 class="text-blue xxl-header" style="line-height: 1.2em"> 
                Contact Us Today
            </h1>
            <p class="text-light">
                <i class="fab fa-twitter-square"></i> 
                <span> info@myvoterapp.com </span> &nbsp;
                <i class="fab fa-twitter-square"></i> 
                <span> +234 706 653 1006 </span>
            </p>
        </div>
    </div>
</div>
@endsection