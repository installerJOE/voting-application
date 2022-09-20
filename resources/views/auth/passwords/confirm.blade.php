@extends('layouts.auth')

@section('meta-content')
    <title> Confirm Password | {{config('app.name')}} </title>
@endsection

@section('auth-title', __('Confirm Password'))

@section('content')
    <div>
        {{ __('Please confirm your password before continuing.') }}
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
            <div class="mt-1">
                <button type="submit" class="btn btn-primary">
                    {{ __('Confirm Password') }}
                </button>
            </div>

            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </form>
    </div>
@endsection
