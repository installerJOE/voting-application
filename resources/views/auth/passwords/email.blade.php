@extends('layouts.auth')

@section('meta-content')
    <title> Forgot Password | {{config('app.name')}} </title>
@endsection

@section('auth-title', __('Forgot Password'))

@section('content')
    <div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <label for="email">
                {{ __('Email Address') }}
            </label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
            <div class="mt-1">
                <button type="submit" class="btn btn-blue-bg">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
                
            <div class="mt-1">
                <a href="{{route('login')}}" class="link-text"> Back to Login </a>
            </div>
        </form>
    </div>
@endsection
