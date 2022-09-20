@extends('layouts.app')

@section('meta-content')
	{{-- <title> {{$contest->name}} | Contest | {{config('app.name')}} </title> --}}
	<title> Contest Name | {{config('app.name')}} </title>
    <link href="{{ asset('css/contest.css') }}" rel="stylesheet">
    <style>
        #contest-opening-div{
            background-image: url('../images/contest.jpg');
        }
        .opening-page-div{
            background-color: rgba(0,0,0,0.55)
        }
        .label-small{
            font-size: 9px
        }
        .contest-status{
            top: 0px;
            left: 0px;
        }
    </style>  
@endsection

@section('content')
    <div class="parent-opening-div">
        <div class="row image-zoom-div" id="contest-opening-div">   
        </div>
        <div class="row opening-page-div">
            <div class="col-md-8 col-sm-9 col-12 text-center" style="float: none; margin:auto">
                <h1 class="text-blue xxl-header" style="line-height: 1.2em"> 
                    {{-- {{$contest->name}} --}}
                    Name of The Contest
                </h1>
            </div>
        </div>
    </div>
    <div class="contest-list-block">
        <div class="col-md-10 col-lg-10 col-sm-12 margin-auto">
            <h1 class="text-blue header">
                Overview of Contest
            </h1>
            <hr class="sub-header-hr"/>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum enim ducimus aliquid accusamus id accusantium, voluptates, corrupti recusandae vero ratione, qui vitae? Magnam incidunt id quod nemo, veritatis dolores quia?
            </p>

            <h1 class="text-blue header mt-2">
                Contestants
            </h1>
            <hr class="sub-header-hr"/>

            <div class="row mt-3 contest-item">
                @for($i=0; $i<10; $i++)
                <div class="col-lg-3 col-md-3 col-sm-4 col-6 contest-image">
                    <a href="{{route('public.showContestant')}}">
                        <img src="{{asset('images/contest.jpg')}}" width="100%" height="auto"/>
                        <p class="contest-status"> 
                            <span class="bg-peach text-white label label-small"> 
                                {{($i+3)*($i-1)}} votes
                            </span> 
                        </p>
                        <p class="contestant-name"> 
                            <span class=""> 
                                Joe Mike
                            </span> 
                        </p>
                    </a>
                </div>
                @endfor
            </div>
        </div>
    </div>
@endsection