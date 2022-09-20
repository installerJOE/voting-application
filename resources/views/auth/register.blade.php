@extends('layouts.auth')

@section('meta-content')
    <title> Register | {{config('app.name')}} </title>
@endsection

@section('auth-title', __('Register'))

@section('content')
    <div>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <label for="name">
                {{ __('Name') }}
            </label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                    
            <label for="email">
                {{ __('Email Address') }}
            </label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                    
            <label for="password">
                {{ __('Password') }}
            </label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
            <label for="password-confirm">
                {{ __('Confirm Password') }}
            </label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                

            <div class="mt-1">
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>
@endsection
