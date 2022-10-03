@extends('user.layout')

@section('meta-content')
    <title> Contests Management | Admin | {{config('app.name')}} </title>
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

@section('content-header', 'Contests Management')

@section('content-body')
<div class="submenu-less-div-content">
    <div class="content-sub-header">
        <h1 class="text-blue sub-header">
            All Contests
        </h1>
    </div> 
    <hr class="sub-header-hr"/>

    <div>
        <a href="{{route('admin.createNewContest')}}" class="btn btn-blue-bd btn-alert-modal">
            Create New Contest
        </a>
    </div>

    <div class="mt-2 analytics-block">
        @forelse($contests as $contest)
            <div class="col-md-12 col-sm-12 col-12 contest-card">
                <div class="card">
                    <h1 class="sub-header text-peach"> 
                        {{$contest->name}}    
                    </h1>
                    <p>
                        {!! Str::words($contest->description, 28, ' . . .') !!} 
                    </p>
                    <p class="mt-1" style="margin-bottom: 0px">
                        <a href="{{route('admin.showContest', ['slug' => $contest->slug])}}" class="btn btn-blue-bg btn-alert-modal">
                            View/Edit    
                        </a>
                        @if($contest->voting_status() == null)
                            <a href="{{route('admin.contests.showContestRequests', ['slug' => $contest->slug])}}" class="btn btn-peach-bg btn-alert-modal">
                                See Requests
                            </a>
                        @endif
                    <p>
                    <p class="contest-status1"> 
                        <span class="{{$contest->vote_end_at > time() && $contest->vote_start_at < time() ? 'bg-green' : 'bg-peach'}} text-white label label-small"> 
                            {{$contest->contestants->count() . '/' . $contest->contestants_needed}}
                        </span> 
                    </p>
                </div>
            </div>
        @empty
        <div class="col-md-12 col-sm-12 col-12 contest-card">
            <div class="card">
                <h1 class="sub-header text-peach"> 
                    No Contest has been added yet
                </h1>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
