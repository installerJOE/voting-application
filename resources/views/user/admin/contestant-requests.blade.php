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
            <button type="button" class="btn btn-peach-bg btn-alert-modal" data-bs-toggle="modal" data-bs-target="#editContestDetailsModal"> 
                Approve marked 
            </button> &nbsp;

            <button type="button" class="btn btn-peach-bg btn-alert-modal" data-bs-toggle="modal" data-bs-target="#editContestDetailsModal"> 
                Deny marked 
            </button> &nbsp;
        </div>
    </div>
</div>

<script>
    function submitConfirmForm(confirmForm){
        document.querySelector(confirmForm).submit();
    }
</script>

@endsection
