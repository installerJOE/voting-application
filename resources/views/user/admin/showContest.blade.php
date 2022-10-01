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

@section('content-header', 'Contests Management')

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
                <button type="button" class="btn btn-peach-bg btn-alert-modal" data-bs-toggle="modal" data-bs-target="#editContestDetailsModal"> 
                    Edit Contest 
                </button> &nbsp;

                @if($contest->voting_status() !== "active")
                    @if($contest->registration_status() == null)
                        <button type="button" class="btn btn-blue-bg btn-alert-modal" data-bs-toggle="modal" data-bs-target="#startContestRegConfirmModal"> 
                            Start Registration 
                        </button> &nbsp;
                    @else
                        <button type="button" class="btn btn-blue-bg btn-alert-modal" data-bs-toggle="modal" data-bs-target="#endContestRegConfirmModal"> 
                            End Registration
                        </button> &nbsp;
                        <button type="button" class="btn btn-blue-bd btn-alert-modal" data-bs-toggle="modal" data-bs-target="#startContestVotingConfirmModal"> 
                            Start Voting Session
                        </button> &nbsp;
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
                    {{$contest->contestants->count()}}/{{$contest->contestants_needed}}
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

    <div class="col-md-12 mt-1">
        <h1 class="sub-header text-peach"> 
            Contest Description/Overview
        </h1>
        <hr class="sub-header-hr"/>
        <p>
            {!!$contest->description!!}
        </p>
    </div> 

    <div class="col-md-12 mt-1">
        <hr class="sub-header-hr"/>
        @if($contest->voting_status() !== "active")
            <button type="button" class="btn btn-blue-bg btn-alert-modal" data-bs-toggle="modal" data-bs-target="#editContestRegDataModal"> 
                Change Registration Data
            </button> &nbsp;
        
            <button type="button" class="btn btn-blue-bd btn-alert-modal" data-bs-toggle="modal" data-bs-target="#editContestVotingDataModal"> 
                Change Voting Data
            </button> &nbsp;
        @endif
    </div>
</div>

@include('user.admin.modals.edit-contest-details')
@include('user.admin.modals.start-contest-reg-confirm')
@include('user.admin.modals.end-contest-reg-confirm')
@include('user.admin.modals.start-contest-voting-confirm')
@include('user.admin.modals.end-contest-voting-confirm')
@include('user.admin.modals.change-contest-voting-date')
@include('user.admin.modals.change-contest-registration-date')

<script>
    function submitConfirmForm(confirmForm){
        document.querySelector(confirmForm).submit();
    }
</script>

@endsection
