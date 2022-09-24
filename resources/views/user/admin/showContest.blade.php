@extends('user.layout')

@section('meta-content')
    <title> Contests Management | Admin | {{config('app.name')}} </title>
    <style>
        .content-sub-header{
            padding: 1.5em;
            background-color: #f2f2f2;
            border: 0px;
        }
        .ctrl-btn{
            padding: 1em;
        }
        .ctrl-btn p{
            margin: 0px
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
            {{$contest->name}}
        </h1>
    </div> 

    <div class="col-md-12 mt-3">
        <div class="card ctrl-btn">
            <p>
                @if($contest->voting_status() !== "active")
                    @if($contest->registration_status() !== "active")
                        <button type="button" class="btn btn-blue-bg btn-alert-modal" data-bs-toggle="modal" data-bs-target="#startContestRegConfirmModal"> 
                            Start Registration 
                        </button>
                    @else
                        <button type="button" class="btn btn-blue-bg btn-alert-modal" data-bs-toggle="modal" data-bs-target="#endContestRegConfirmModal"> 
                            End Registration
                        </button>
                        <button type="button" class="btn btn-blue-bd btn-alert-modal" data-bs-toggle="modal" data-bs-target="#startContestVotingConfirmModal"> 
                            Start Voting Session
                        </button>
                    @endif
                @else
                    <button type="button" class="btn btn-blue-bd btn-alert-modal" data-bs-toggle="modal" data-bs-target="#endContestVotingConfirmModal"> 
                        End Voting
                    </button>
                @endif
            </p>
        </div>
    </div>

    <div class="col-md-12 mt-2 analytics-block">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 analytics-card">
            <div class="card">
                <p class="text-grey"> Registered Contestants </p>
                <h1 class="sub-header text-blue"> 
                    {{$contest->contestants->count()}}
                </h1>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12 analytics-card">
            <div class="card">
                <p class="text-grey"> Total Votes </p>
                <h1 class="sub-header text-blue"> 
                    {{$contest->total_votes()}}
                </h1>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12 analytics-card">
            <div class="card">
                <p class="text-grey"> Registration Status </p>
                <h1 class="sub-header text-blue"> 
                    {{$contest->registration_status() ?? "N/A"}}
                </h1>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12 analytics-card">
            <div class="card">
                <p class="text-grey"> Voting Status </p>
                <h1 class="sub-header text-blue"> 
                    {{$contest->voting_status() ?? "N/A"}}
                </h1>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12 analytics-card">
            <div class="card">
                <p class="text-grey"> Highest Votes Per Contestant </p>
                <h1 class="sub-header text-blue"> 
                    {{$contest->highest_votes() ?? "N/A"}}
                </h1>
            </div>
        </div>

    </div>
</div>

@include('user.admin.modals.start-contest-reg-confirm')
@include('user.admin.modals.end-contest-reg-confirm')
@include('user.admin.modals.start-contest-voting-confirm')
@include('user.admin.modals.end-contest-voting-confirm')

<script>
    function submitConfirmForm(confirmForm){
        document.querySelector(confirmForm).submit();
    }
</script>

@endsection
