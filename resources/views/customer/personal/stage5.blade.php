@extends('layouts.customer.personal.master')

@section('content')
<main>
        <div class="container">
            <div class="quote-stage-5 bg-yellow">
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
                    <div class="stage-border tick">
                        <div class="stage-number"><i class="fas fa-check"></i></div>
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
                    <div class="delivery-details-island bg-yellow">

                    </div>
                    <div class="payment-island bg-yellow">

                    </div>
                </div>
                <div class="right-islands">
                    <div class="quote-island">
                        <div class="logo-circle">
                            <img src="/assets/images/circle-logo.png" alt="">
                        </div>
                        <div class="quote-body bg-white">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<style>

.delivery-details-island {
    width: 100%;
}
.payment-island {
    width: 100%;
}

</style>
@endsection

@section('styles')
@parent
<link href="{{ asset('css/personal.stage5.css') }}" rel="stylesheet">
@endsection
