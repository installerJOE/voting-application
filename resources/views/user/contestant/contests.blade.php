@extends('user.layout')

@section('meta-content')
    <title> My Contests | {{config('app.name')}} </title>
    <style>
        .contest-card > .card{
            position: relative;
            margin-bottom: 1em
        }
        .contest-status1{
            position: absolute !important;
            top: 10px;
            right: 10px;
        }
    </style>
@endsection

@section('content-header')
    <h1 class="header">
        Contests 
    </h1>
@endsection

@section('content-body')

<div class="submenu-less-div-content">
    <div class="col-md-12 text-right">
        <a href="{{route('public.contests')}}" class="btn btn-blue-bd btn-alert-modal" style="float:right"> 
            All Contests
        </a>
    </div>
    <div class="content-sub-header">
        <h1 class="text-blue sub-header">
            My Contests
        </h1>
    </div> 
    <hr class="sub-header-hr"/>

    <div class="mt-2 analytics-block">
        @forelse($contestants as $contestant)
            <div class="col-md-12 col-sm-12 col-12 contest-card">
                <div class="card">
                    <h1 class="sub-header text-peach"> 
                        {{$contestant->contest->name}}    
                    </h1>
                    <p>
                        {!! Str::words($contestant->profile_overview, 28, ' . . .') !!} 
                    </p>
                    <p class="mt-1" style="margin-bottom: 0px">
                        <a href="{{route('user.showContest', ['slug' => $contestant->contest->slug])}}" class="btn btn-blue-bg btn-alert-modal">
                            View    
                        </a>
                    <p>
                    <p class="contest-status1"> 
                        <span class="{{$contestant->status == "approved" ? 'bg-green' : 'bg-peach'}} text-white label label-small"> 
                            @if($contestant->approved)
                                {{$contestant->number_of_votes ?? 0}} vote(s)
                            @else
                                {{$contestant->status}}
                            @endif
                        </span> 
                    </p>
                </div>
            </div>
        @empty
        <div class="col-md-12 col-sm-12 col-12 contest-card">
            <div class="card">
                <h1 class="caption-header text-peach"> 
                    You have not registered for any contest yet.
                </h1>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
