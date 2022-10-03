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
        img{
            border-radius: 10px;
        }
        .contest-image:first-child{
            margin-left: -10px;
        }
        .contest-image{
            padding:0px 10px 10px 10px;
        }
        .contest-image:hover{
            cursor: pointer;
        }
    </style>
@endsection

@section('content-header', 'Contests Management')

@section('content-body')
<div class="col-md-12 text-right">
    <a href="{{route('admin.contests.overview')}}" class="btn btn-blue-bd btn-alert-modal" style="float:right"> 
        Back to Contests
    </a>
</div>
<div class="submenu-less-div-content">
    <div class="col-md-12 mt-1 card content-sub-header">
        <h1 class="sub-header text-peach"> 
            {{$contest->name}}
        </h1>
    </div> 
    
    @if($contest->contestants->count() > 0)
        <div class="col-md-12 mt-1">
            <button type="button" class="btn btn-blue-bg btn-alert-modal" data-bs-toggle="modal" data-bs-target="#editContestDetailsModal"> 
                Approve marked 
            </button> &nbsp;

            <button type="button" class="btn btn-peach-bg btn-alert-modal" data-bs-toggle="modal" data-bs-target="#editContestDetailsModal"> 
                Deny marked 
            </button> &nbsp;
        </div>

        <div class="mt-2 col-md-12 col-lg-12 col-sm-12 col-12">
            <h1 class="text-blue sub-header">
                Pending Contestants
            </h1>
            <hr class="sub-header-hr"/>
            <button type="button" class="btn btn-blue-bd btn-alert-modal" onclick="activateMarkBox()"> 
                Mark Contestants
            </button> &nbsp;

            <div class="mt-2">
                @foreach($contest->contestants()->where('status', 'requested')->get() as $contestant)
                    <div class="col-lg-3 col-md-3 col-sm-4 col-6 contest-image" 
                        onclick="showContestantRequestDetail('{{$contestant}}', '{{$contestant->images}}', '{{config('app.url')}}')">
                        <img src="{{asset('images/contestants/' . $contestant->images->first()->image_url)}}" width="100%" height="auto"/>
                        <p class="contestant-name" style="margin-bottom:0px"> 
                            <span class=""> 
                                #{{$contestant->contestant_number}}
                            </span> 
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-2 col-md-12 col-lg-12 col-sm-12 col-12">
            <h1 class="text-blue sub-header">
                Approved Contestants
            </h1>
            <hr class="sub-header-hr"/>

            <div class="mt-2">
                @foreach($contest->contestants()->where('status', 'accepted')->get() as $contestant)
                    <div class="col-lg-3 col-md-3 col-sm-4 col-6 contest-image" >
                        {{-- onclick="showContestantRequestDetail('{{$contestant}}', '{{$contestant->images}}', '{{config('app.url')}}')" --}}
                        <img src="{{asset('images/contestants/' . $contestant->images->first()->image_url)}}" width="100%" height="auto"/>
                        <p class="contestant-name" style="margin-bottom:0px"> 
                            <span class=""> 
                                #{{$contestant->contestant_number}}
                            </span> 
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="mt-2 col-md-12 col-lg-12 col-sm-12 col-12">
            <h1 class="caption-header text-blue" style="padding-left: 1em">
                Sorry, No Applicants yet.
            </h1>
        </div>
    @endif
</div>

@include('user.admin.modals.contestant-request-details')

<script>
    function activateMarkBox(){
        
    }
</script>

@endsection
