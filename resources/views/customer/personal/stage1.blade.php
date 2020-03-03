@extends('layouts.customer.personal.master')

@section('content')
<main>
    <div class="container">
        <div class="quote-stage-1 bg-yellow">
            <div class="arrow-down"></div>
            <h1 class="tc tc-white"><span class="bold">Send a Parcel</span></h1>
            <p class="tc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod<br>
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
            </p>
            <div class="progress">
                <div class="stage-border">
                    <div class="stage-number">1</div>    
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
            <div class="parcel-form-container">
                <form action="{{route('stage2')}}" method="POST">
                    @csrf
                    <ul class="form-rows">
                        <li class="form-row row-1">
                            <div class="form-input from-input">
                                <label for="from">FROM:</label>
                                <input id="from" name="from" type="text" value="GB" readonly>
                            </div>
                            <div class="form-input to-input">
                                <label for="to">TO:</label>
                                <select id="to" name="toCountryCode" type="text">
                                    <option>Select a country...</option>
                                    @foreach ($countries as $country)
                                        @if ($country->zone != 0)
                                            <option value="{{$country->code}}">{{$country->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-input postcode-input">
                                <label for="postcode">YOUR POSTCODE (UK):</label>
                                <input id="postcode" name="postcode" type="text" value="SL09BU">
                            </div>
                        </li>
                        <li class="form-row row-2">
                            <!-- <div class="form-input quantity-input">
                                <label for="quantity">QUANTITY:</label>
                                <input id="quantity" name="quantity" type="text" value="2">
                            </div> -->
                            <div class="form-input weight-input">
                                <label for="weight">WEIGHT:</label>
                                <input id="weight" name="weight" type="text" value="10">
                            </div>
                            <div class="form-input dim-input length-input">
                                <label for="length">LENGTH:</label>
                                <input id="length" name="length" type="text" value="10">
                            </div>
                            <div class="form-input dim-input width-input">
                                <label for="width">WIDTH:</label>
                                <input id="width" name="width" type="text" value="10">
                            </div>
                            <div class="form-input dim-input height-input">
                                <label for="height">HEIGHT:</label>
                                <input id="height" name="height" type="text" value="10">
                            </div>
                        </li>
                        <li class="form-row row-3">
                            <span class="bold"><i class="fas fa-plus"></i>&nbsp;WANT TO SEND ADDITIONAL PACKAGES:</span>&nbsp;&nbsp;<a class="business-link bold" href="#">SET UP A BUSINESS ACCOUNT</a>
                        </li>
                        <li class="form-row row-4">
                            <label class="cb-container">
                                <input type="checkbox" name="terms">
                                <span class="checkmark"></span>
                            </label>
                            <span class="bold terms-text">I agree to the terms and conditions which can be found <a href="#">here</a>.</span>
                        </li>
                        <li class="form-row row-5">
                            <input class="bold" type="submit" value="CONTINUE QUOTE">
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@section('styles')
@parent
<link href="{{ asset('css/personal.stage1.css') }}" rel="stylesheet">
@endsection
