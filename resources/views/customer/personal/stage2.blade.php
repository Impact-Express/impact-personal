@extends('layouts.customer.personal.master')

@section('content')
<main>
    <div class="container">
        <div class="quote-stage-2 bg-yellow">
            <div class="arrow-down"></div>
            <h1 class="tc tc-white"><span class="bold">Send a Parcel</span></h1>
            <p class="tc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod<br>
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
            </p>
            <div class="progress">
                <div class="stage-border tick">
                    <div class="stage-number"><i class="fas fa-check"></i></div>    
                </div>
                <div class="stage-line"></div>
                <div class="stage-border">
                    <div class="stage-number">2</div>
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
    </div>
    <div class="container">
        <div class="quote-container bg-yellow">
            <div class="quote-box">
                <div class="carrier-logo-container">
                    <img class="carrier-logo" src="assets/images/hermes-parcelshop.png" alt="Hermes Logo">
                </div>
                <div class="service-name-container">
                    <p class="service-name">Hermes ParcelShop Pickup <a id="info" href="{{route('locateHermesParcelShop')}}" target="_blank"><i id="info-logo" class="fas fa-info-circle"></i></a> <i id="printer-logo" class="fas fa-print"></i></p>
                    <p class="delivery-estimate">Delivery in 3 to 5 days</p>
                </div>
                <div class="price-container">
                    <p class="price">£{{money_format('%n',$price)}}</p>
                </div>
                <div class="button-container">
                    <form action="{{route('stage3')}}" method="post">
                        @csrf
                        <input class="button-black" type="submit" value="Book Now">
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('styles')
@parent
<link href="{{ asset('css/personal.stage2.css') }}" rel="stylesheet">
@endsection

@section('scripts')
<script src="{{ asset('js/tooltip.js') }}" defer></script>
@endsection