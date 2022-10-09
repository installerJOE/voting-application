@extends('layouts.contest')

@section('meta-content')
	<title> {{$contestant->contest->name}} | {{config('app.name')}} </title>
    <link href="{{ asset('css/contest.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="contest-list-block">
        <div class="col-md-10 col-lg-10 col-sm-12 margin-auto">
            <h1 class="text-peach header">
                {{$contestant->user->name}}
            </h1>
            <hr class="sub-header-hr"/>
            
            <div class="row mt-3 contest-item">
                @foreach($contestant->images as $image)
                    <div class="col-lg-4 col-md-4 col-sm-4 col-6 contest-image">
                        <img src="{{asset('images/contestants/' . $image->image_url)}}" width="100%" height="auto"/>
                    </div>
                @endforeach

                <p>
                    <span class="bg-peach text-white label label-small"> 
                        {{$contestant->number_of_votes}} votes 
                    </span> 
                </p>
                <div class="col-lg-8 col-md-8 col-sm-6 col-12">
                    <h1 class="text-blue header">
                        Profile
                    </h1>
                    <p>
                        {{$contestant->profile_overview}}
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
    @include('public.modals.voter-modal')
@endsection
