@extends('user.layout')

@section('meta-content')
    <title> Contests Management | Admin | {{config('app.name')}} </title>
    <style>
        .content-sub-header{
            padding: 1.5em;
            background-color: #f2f2f2;
            border: 0px;
        }
        .form-group{
            padding: 2em;
            border: 1px solid #d9d9d9;
            border-radius: 5px
        }
        .form-table{
            width: 100%
        }
        .form-table td{
            padding: 0px 10px;
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
    <div class="col-md-12 col-sm-12 col-12 mt-1 card content-sub-header">
        <h1 class="sub-header text-peach"> 
            Create New Contest
        </h1>
    </div> 

    <div class="col-md-12 col-sm-12 col-12 mt-2">
       <form method="POST" action="{{route('admin.storeContest')}}">
            @csrf
            <div class="form-group">
                <h1 class="caption-header text-blue"> Base Data </h1>
                <hr class="sub-header-hr"/>
                
                <label> Name of Contest </label>
                <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="e.g. August Break Beauty Contest"/>

                <label> Description/Overview </label>
                <textarea class="form-control" name="description" rows="5">{{old('description')}}</textarea>

                <table class="form-table">
                    <tr>
                        <td> <label> Total Number of Contestants </label> </td>
                        <td> <label> Prize </label> </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="number" class="form-control" name="number_of_contestants" value="{{old('number_of_contestants')}}" placeholder="e.g. 100"/>
                        </td>
                        <td>
                            <input type="text" name="prize" value="{{old('prize')}}" class="form-control" placeholder="e.g. Cash Prize of #10,000"/>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="form-group mt-2">
                <h1 class="caption-header text-blue"> 
                    Registration Data
                </h1>
                <hr class="sub-header-hr"/>
                <table class="form-table">
                    <tr>
                        <td> <label>  Start Date </label> </td>
                        <td> <label> Duration of Registration (Days) </label> </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="date" name="registration_start_date" value="{{old('registration_start_date')}}" class="form-control"/>
                        </td>
                        <td>
                            <input type="number" name="registration_duration" value="{{old('registration_duration')}}" class="form-control" placeholder="e.g. 10"/>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="form-group mt-2">
                <h1 class="caption-header text-blue"> 
                    Contest Voting Data
                </h1>
                <hr class="sub-header-hr"/>
                <table class="form-table">
                    <tr>
                        <td> <label>  Start Date </label> </td>
                        <td> <label> Duration of Voting (Days) </label> </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="date" name="voting_start_date" value="{{old('voting_start_date')}}" class="form-control"/>
                        </td>
                        <td>
                            <input type="number" name="voting_duration" value="{{old('voting_duration')}}" class="form-control" placeholder="e.g. 10"/>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="mt-2">
                <button type="submit" class="btn btn-blue-bg btn-alert-modal"> 
                    Create Contest 
                </button>
            </div>
       </form>
    </div>
</div>
@endsection
