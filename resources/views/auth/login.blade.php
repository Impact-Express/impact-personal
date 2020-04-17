@extends('layouts.customer.personal.master')

@section('content')
<div class="container bg-yellow">
    <div class="register-form-container">
        <form action="{{route('login')}}" method="POST">
            @csrf
            <ul class="form-rows">
                <li class="form-row row-1">
                    <div class="form-input title-input @error('title') is-invalid @enderror">
                        <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="EMAIL ADDRESS...">
                    </div>
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </li>
                <li class="form-row row-2">
                    <div class="form-input su-email-input @error('email') is-invalid @enderror">
                        <input type="password" name="password" required autocomplete="current-password" placeholder="PASSWORD...">
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </li>
                <li class="form-row row-6">
                    <button type="submit" class="cont bold button-black">
                        {{ __('LOGIN') }}
                    </button>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </li>
            </ul>
                
        </form>
    </div>
</div>
@endsection

@section('styles')
@parent
<link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endsection