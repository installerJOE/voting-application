@extends('layouts.auth')

@section('meta-content')
    <title> Verify Email | {{config('app.name')}} </title>
@endsection

@section('auth-title', __('Verify Email Address'))

@section('content')
    <div>
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        <p class="text-light">
            {{ __('Before proceeding, please check your email for a verification link.') }}
        </p>
        
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline text-blue">
                {{ __('Click here to request another verification link') }}
            </button>
        </form>
    </div>
@endsection