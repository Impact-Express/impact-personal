@extends('layouts.customer.personal.master')

@section('content')
<main>
    <div class="container">
        <div class="quote-stage-3 bg-yellow">
            <div class="arrow-down"></div>
            <h1 class="tc tc-white">personal <span class="bold">quote</span></h1>
            <p class="tc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod<br>
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
            </p>
            <div class="progress">
                <div class="stage-border tick">
                    <div class="stage-number"><i class="fas fa-check"></i></div>
                </div>
                <div class="stage-line"></div>
                <div class="stage-border tick">
                    <div class="stage-number"><i class="fas fa-check"></i></div>
                </div>
                <div class="stage-line"></div>
                <div class="stage-border">
                    <div class="stage-number">3</div>
                </div>
                <div class="stage-line"></div>
                <div class="stage-border">
                    <div class="stage-number">4</div>
                </div>
                <div class="stage-line"></div>
                <div class="stage-border">
                    <div class="stage-number">5</div>
                </div>
            </div>
            <div class="stage-text">
                <p>PACKAGE DETAILS</p>
                <p>PRICE & DELIVETY<br>OPTIONS</p>
                <p>SETUP ACCOUNT<br>OR LOGIN</p>
                <p>ADDRESS DETAILS</p>
                <p>PAYMENT OPTIONS</p>
            </div>
        </div>
        <div class="island-container">
            <div class="left-islands">
                <div class="login-island-container bg-yellow">
                    <h3 class="tc-white">ALREADY HAVE AN ACCOUNT?</h3>
                    <form class="login-form" action="{{ route('login-from-stage-3') }}" method="POST">
                        @csrf
                        <div class="form-input email-input">
                            <input class="@error('login-email') is-invalid @enderror" id="login-email" name="login-email" type="email" placeholder="EMAIL ADDRESS..." autocomplete="email" value="{{old('login-email')}}">
                        </div>
                        <div class="form-input password-input">
                            <input class="@error('login-password') is-invalid @enderror" id="login-password" name="login-password" type="text" placeholder="PASSWORD...">
                        </div>
                        <input class="bold button-black" type="submit" value="LOGIN">
                    </form>
                    <p><a class="pw-reset-link" href="#">Forgot your password?</a></p>
                    <p class="error-container">
                        @if(Session::get('loginError') !== null)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ Session::get('loginError') }}</strong>
                            </span>
                        @endif
                    </p>
                </div>
                <div class="signup-island-container bg-yellow">
                    <h3 class="tc-white">ACCOUNT SETUP</h3>
                    <form action="{{route('register')}}" method="POST">
                        @csrf
                        <ul class="form-rows">
                            <li class="form-row row-1">
                                <div class="form-input title-input">
                                    <input class="@error('title') is-invalid @enderror" type="text" name="title" placeholder="TITLE...">
                                </div>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-input firstname-input">
                                    <input class="@error('firstName') is-invalid @enderror" type="text" name="firstName" placeholder="FIRST NAME..." value="{{old('firstName')}}">
                                </div>
                                @error('firstName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-input lastname-input">
                                    <input class=" @error('lastName') is-invalid @enderror" type="text" name="lastName" placeholder="LAST NAME..." value="{{old('lastName')}}">
                                </div>
                                @error('lastName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </li>
                            <li class="form-row row-2">
                                <div class="form-input su-email-input">
                                    <input class=" @error('email') is-invalid @enderror" type="text" name="email" placeholder="EMAIL ADDRESS..." value="{{old('email')}}">
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-input phone-input">
                                    <input class=" @error('phone') is-invalid @enderror" type="text" name="phone" placeholder="PHONE NO..." value="{{old('phone')}}">
                                </div>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </li>
                            <li class="form-row row-3">
                                <div class="form-input su-password-input">
                                    <input class=" @error('password') is-invalid @enderror" type="text" name="password" placeholder="ENTER A PASSWORD...">
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-input password-confirm-input">
                                    <input class=" @error('password_confirmation') is-invalid @enderror" type="text" name="password_confirmation" placeholder="CONFIRM PASSWORD...">
                                </div>
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </li>
                            <li class="form-row row-4">
                                <div class="form-input address-input">
                                    <input type="text" name="address" placeholder="ENTER A POSTCODE TO FIND ADDRESS..." value="{{old('address')}}">
                                </div>
                                <input class="bold button-grey" type="submit" value="FIND ADDRESS">
                            </li>
                            <li class="form-row row-5">
                                <label class="cb-container">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="bold terms-text">I agree to the terms and conditions which can be found <a href="#">here</a>.</span>
                            </li>
                            <li class="form-row row-6">
                                <input class="cont bold button-black" type="submit" value="REGISTER">
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
            <div class="right-islands">
                <div class="quote-island">
                    <div class="logo-circle">
                        <img src="/assets/images/circle-logo.png" alt="Impact Express Wholesale Ltd">
                    </div>
                    <div class="quote-body bg-white">
                        <div class="quote-content">
                            <div><span class="bold">From: </span>{{$bookingData['fromCountry']}}</div>
                            <div><span class="bold">To: </span>{{$bookingData['toCountry']}}</div>
                            
                            <div><span class="bold">Weight: </span>{{$bookingData['weight']}}</div>
                            <div><span class="bold">Length: </span>{{$bookingData['length']}}</div>
                            <div><span class="bold">Width: </span>{{$bookingData['width']}}</div>
                            <div><span class="bold">Height: </span>{{$bookingData['height']}}</div>
                            <div><span class="bold">Price: </span>£{{money_format('%n',$bookingData['price'])}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('styles')
@parent
<link href="{{ asset('css/personal.stage3.css') }}" rel="stylesheet">
@endsection