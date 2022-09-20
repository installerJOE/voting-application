@extends('layouts.contest')

@section('meta-content')
	{{-- <title> {{$contest->name}} | Contest | {{config('app.name')}} </title> --}}
	<title> Contest Name | {{config('app.name')}} </title>
    <link href="{{ asset('css/contest.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="contest-list-block">
        <div class="col-md-10 col-lg-10 col-sm-12 margin-auto">
            <h1 class="text-peach header">
                Joe Mike
            </h1>
            <hr class="sub-header-hr"/>
            
            <div class="row mt-3 contest-item">
                @for ($i = 0; $i < 3; $i++)
                    <div class="col-lg-4 col-md-4 col-sm-4 col-6 contest-image">
                        <img src="{{asset('images/contest.jpg')}}" width="100%" height="auto"/>
                    </div>
                @endfor

                <p>
                    <span class="bg-peach text-white label label-small"> 
                        20 votes
                    </span> 
                </p>
                <div class="col-lg-8 col-md-8 col-sm-6 col-12">
                    <h1 class="text-blue header">
                        Profile
                    </h1>
                    <p>
                        This is the little information we have about this particular user.
                    </p>
                    <p class="mt-4">
                        <button class="btn btn-blue-bg" data-bs-toggle="modal" data-bs-target="#voteContestantModal"
                        onclick="showVoteContestantModal()">
                            Vote Contestant
                        </button>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('public.modals.voter-modal')
