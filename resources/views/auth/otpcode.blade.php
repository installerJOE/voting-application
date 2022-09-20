@extends('layouts.auth')

@section('meta-content')
    <title> One-Time-Password | {{config('app.name')}} </title>
@endsection

@section('auth-title', __('One-Time-Password'))

@section('content')
    <div>
        {{ __('Please enter the One-Time-Password (OTP) code thats was sent to your email') }}
        <form method="POST" action="{{ route('otpcode.submit') }}">
        @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="otp_code" value="{{ old('otp_code') }}" required placeholder="Enter OTP Code">
            </div>
                
            <div class="mt-1">
                <button type="submit" class="btn btn-orange-bg">
                    {{ __('Submit') }}
                </button>
            </div>
                
            <div class="mt-1 text-left">
                Didn't receive any code?
                <a class="text-orange link-text" href="{{ route('otpcode.resend') }}">
                    {{ __(' Resend code') }}
                </a>
            </div>
        </form>
    </div>
@endsection
