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
                <div class="stage-border tick">
                    <div class="stage-number"><i class="fas fa-check"></i></div>
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
                <div class="address-island bg-yellow">
                    <h4 class="tc-white">DELIVERY DETAILS</h4>
                </div>
            </div>
            <div class="right-islands">
                <div class="quote-island">
                    <div class="logo-circle">
                        <img src="images/circle-logo.png" alt="">
                    </div>
                    <div class="quote-body bg-white">
dfadsfds    
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<style>

.address-island {
    width: 100%;
    margin-bottom: 30px;
    padding: 50px;

    height: 500px;
}
.address-island h4 {
    margin-top: 0;
}
.payment-island {
    width: 100%;
    height: 500px;
}
</style>
@endsection

@section('styles')
@parent
<link href="{{ asset('css/personal.stage4.css') }}" rel="stylesheet">
@endsection
