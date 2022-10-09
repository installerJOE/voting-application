@extends('layouts.auth')

@section('meta-content')
    <title> Login | {{config('app.name')}} </title>
@endsection

@section('auth-title', __('Login'))

@section('content')
    <div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label for="email" >
                {{ __('Email Address') }}
            </label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            
            <label for="password">
                {{ __('Password') }}
            </label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            
            @if (Route::has('password.request'))
                <a class="link-text" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
                
            <div class="mt-1">
                <button type="submit" class="btn btn-blue-bg">
                    {{ __('Login') }}
                </button>
            </div>

            <div class="mt-1">
                You don't have an account yet?
                <a href="{{route('register')}}" class="text-blue link-text">
                    {{ __('Register here') }}
                </a>
            </div>
        </form>
    </div>
@endsection
