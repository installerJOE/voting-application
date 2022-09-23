@extends('user.layout')

@section('meta-content')
    <title> Password/Security | {{config('app.name')}} </title>
    <style>
        .form-field{
            padding: 3em;
            background-color: #f5f5f5;
            border-radius: 15px;
            margin: 1em
        }
    </style>
@endsection

@section('content-header')
    <h1 class="header">
        Password/Security
    </h1>
@endsection

@section('content-body')
    <div class="form-field">
        <h1 class="caption-header text-purple">
            Change Password
        </h1>
        <form action="{{route('users.updatePassword')}}" method="POST" class="mt-2">
            @csrf
            <div class="form-group">
                <label> New password </label>
                <input type="password" class="form-control" name="password" placeholder="******" required/>
            </div>
            
            <div class="form-group">
                <label> Re-type Password </label>
                <input type="password" class="form-control" name="password_confirmation" placeholder="******" required/>
            </div>

            <div class="form-group">
                <button class="btn btn-blue-bg btn-alert-modal">
                    Change Password
                </button>
            </div>
        </form>
    </div>
    <hr/>
@endsection
