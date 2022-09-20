@extends('layouts.app')

@section('meta-content')
	<title> Vote | {{config('app.name')}} </title>
    <link href="{{ asset('css/contest.css') }}" rel="stylesheet">
    <style>
        #contest-opening-div{
            background-image: url('../images/contest.jpg');
        }
        .opening-page-div{
            background-color: rgba(0,0,0,0.55)
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
                    Welcome to the Official Contests Page
                </h1>
            </div>
        </div>
    </div>

    <div class="contest-list-block">
        <div class="col-md-10 col-lg-10 col-sm-12 margin-auto">
            <h1 class="text-blue header">
                Active Contests
            </h1>
            <hr class="sub-header-hr"/>
            @for($i=0; $i<5; $i++)
            <div class="row mt-3 contest-item">
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 contest-image">
                    <img src="{{asset('images/contest.jpg')}}" width="100%" height="auto"/>
                    <p class="contest-status"> 
                        <span class="{{$i%2 == 0 ? 'bg-green' : 'bg-peach'}} text-white label label-small"> 
                            {{$i%2 == 0 ? 'active' : 'closed'}}
                        </span> 
                    </p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-6 col-12">
                    <h1 class="text-peach caption-header">
                        Contest Title 
                    </h1>
                    <p>
                        This is the description of the contest . . .
                    </p>
                    <p>
                        <a href="{{route('public.showContest')}}" class="btn btn-blue-bd btn-alert-modal">
                            Visit Contest
                        </a>
                    </p>
                </div>
            </div>
            @endfor
        </div>
    </div>
@endsection