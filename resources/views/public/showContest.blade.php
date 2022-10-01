@extends('layouts.app')

@section('meta-content')
	<title> {{$contest->name}} | Contest | {{config('app.name')}} </title>
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
                    {{$contest->name}}
                </h1>
                <p class="text-light"> {{$contest->prize}} </p>
            </div>
        </div>
    </div>
    <div class="contest-list-block">
        <div class="col-md-10 col-lg-10 col-sm-12 margin-auto">
            <h1 class="text-blue header">
                Overview/Description
            </h1>
            <hr class="sub-header-hr"/>
            <p>
                {!! $contest->description !!}
            </p>

            @if($contest->voting_status() !== null)
                <h1 class="text-blue sub-header mt-2">
                    Contestants
                </h1>
                <hr class="sub-header-hr"/>
                <div class="row mt-3 contest-item">
                    @forelse($contest->contestants as $contestant)
                        <div class="col-lg-3 col-md-3 col-sm-4 col-6 contest-image">
                            <a href="{{route('public.showContestant')}}">
                                <img src="{{asset('images/contest.jpg')}}" width="100%" height="auto"/>
                                <p class="contest-status"> 
                                    <span class="bg-peach text-white label label-small"> 
                                        {{$contestant->number_of_votes}} votes
                                    </span> 
                                </p>
                                <p class="contestant-name"> 
                                    <span class=""> 
                                        {{$contestant->name}}
                                    </span> 
                                </p>
                            </a>
                        </div>
                    @empty
                        <div>
                            <h1 class="caption-header">
                                No contestants yet.
                            </h1>
                        </div>
                    @endforelse
                </div>
            @elseif($contest->registration_status() !== null && $contest->registration_status() !== "closed")
                <div>
                    <h1 class="text-peach sub-header mt-2">
                        Registration Is On Now!
                    </h1>
                    <hr class="sub-header-hr"/>
                    <p>
                        If you feel that you are qualified for this contest and you're interested
                        in winning the prize, 
                        @guest login now @else proceed to registration form @endguest by clicking the button below! 
                    </p>

                    @guest
                        <p>
                            <a href="{{route('login')}}" class="btn btn-alert-modal btn-peach-bg">
                                Login
                            </a>
                        </p>
                        <p>
                            You don't have an acccount with us yet? 
                            <a href="{{route('register')}}" class="text-peach text-underlined link-text"> Register here </a>
                        </p>
                    @else
                        <p>
                            <a href="{{route('user.contests.register', ['contest' => $contest->slug])}}" class="btn btn-peach-bg">
                                Apply Now!
                            </a>
                        </p>
                    @endguest
                </div>
            @else

            @endif
        </div>
    </div>
@endsection