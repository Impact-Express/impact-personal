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
                        <form class="login-form" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-input email-input">
                                <input class="@error('email') is-invalid @enderror" id="email" name="email" type="email" placeholder="EMAIL ADDRESS..." autocomplete="email" value="{{old('email')}}">
                            </div>
                            <div class="form-input password-input">
                                <input class="@error('password') is-invalid @enderror" id="password" name="password" type="text" placeholder="PASSWORD...">
                            </div>
                            <input class="bold button-black" type="submit" value="LOGIN">
                        </form>
                        <p><a class="pw-reset-link" href="#">Forgot your password?</a></p>
                        <p class="error-container">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </p>
                    </div>
                    <div class="signup-island-container bg-yellow">
                        <h3 class="tc-white">ACCOUNT SETUP</h3>
                        <form class="signup-form" action="#" method="POST">
                            <ul class="form-rows">
                                <li class="form-row row-1">
                                    <div class="form-input title-input">
                                        <input type="text">
                                    </div>
                                    <div class="form-input firstname-input">
                                        <input type="text" placeholder="FIRST NAME...">
                                    </div>
                                    <div class="form-input lastname-input">
                                        <input type="text" placeholder="LAST NAME...">
                                    </div>
                                </li>
                                <li class="form-row row-2">
                                    <div class="form-input su-email-input">
                                        <input type="text" placeholder="EMAIL ADDRESS...">
                                    </div>
                                    <div class="form-input phone-input">
                                        <input type="text" placeholder="PHONE NO...">
                                    </div>
                                </li>
                                <li class="form-row row-3">
                                    <div class="form-input su-password-input">
                                        <input type="text" placeholder="ENTER A PASSWORD...">
                                    </div>
                                    <div class="form-input password-confirm-input">
                                        <input type="text" placeholder="CONFIRM PASSWORD...">
                                    </div>
                                </li>
                                <li class="form-row row-4">
                                    <div class="form-input address-input">
                                        <input type="text" placeholder="ENTER A POSTCODE TO FIND ADDRESS...">
                                    </div>
                                    <input class="bold button-grey" type="submit" value="FIND ADDRESS">
                                </li>
                                <li class="form-row row-5">
                                    <label class="cb-container">
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                        Terms and conditions blah blah blah
                                    </label>
                                </li>
                                <li class="form-row row-6">
                                    <input class="back bold button-grey" type="submit" value="BACK TO QUOTE">
                                    <input class="cont bold button-black" type="submit" value="CONTINUE">
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