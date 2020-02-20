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
                    <form action="{{route('stage5')}}" method="POST">
                        @csrf
                        <ul class="form-rows">
                            <li class="form-row row-0">
                                <h4 class="tc-white">DELIVERY DETAILS</h4>
                            </li>
                            <li class="form-row row-1">
                                <div class="form-input consignee-name-input">
                                    <input class="@error('consignee-name') is-invalid @enderror" type="text" name="consignee-name" placeholder="NAME...">
                                </div>                                
                            </li>
                            <li class="form-row row-2">
                                <div class="form-input consignee-address-line-1-input">
                                    <input class=" @error('consignee-address-line-1') is-invalid @enderror" type="text" name="consignee-address-line-1" placeholder="ADDRESS LINE 1...">
                                </div>
                            </li>
                            <li class="form-row row-3">
                                <div class="form-input consignee-address-line-2-input">
                                    <input class=" @error('consignee-address-line-2') is-invalid @enderror" type="text" name="consignee-address-line-2" placeholder="ADDRESS LINE 2...">
                                </div>
                            </li>
                            <li class="form-row row-4">
                                <div class="form-input consignee-address-line-3-input">
                                    <input class=" @error('consignee-address-line-3') is-invalid @enderror" type="text" name="consignee-address-line-3" placeholder="ADDRESS LINE 3...">
                                </div>
                            </li>
                            <li class="form-row row-5">
                                <div class="form-input consignee-city-input">
                                    <input class=" @error('consignee-city') is-invalid @enderror" type="text" name="consignee-city" placeholder="CITY...">
                                </div>
                            </li>
                            <li class="form-row row-6">
                                <div class="form-input consignee-country-input">
                                    <input class=" @error('consignee-country') is-invalid @enderror" type="text" name="consignee-country" placeholder="COUNTRY...">
                                </div>
                            </li>
                            <li class="form-row row-7">
                                <div class="form-input consignee-postcode-input">
                                    <input class=" @error('consignee-postcode') is-invalid @enderror" type="text" name="consignee-postcode" placeholder="POSTCODE...">
                                </div>
                            </li>
                            <li class="form-row row-8">
                                <div class="form-input consignee-phone-input">
                                    <input class=" @error('consignee-phone') is-invalid @enderror" type="text" name="consignee-phone" placeholder="PHONE NO...">
                                </div>
                            </li>
                            <li class="form-row row-10">
                                <h4 class="tc-white">CONTENTS</h4>
                            </li>
                            <li class="form-row row-11">
                                <div class="form-input contents-description-input">
                                    <input class=" @error('contents-description') is-invalid @enderror" type="text" name="contents-description" placeholder="DESCRIPTION...">
                                </div>
                            </li>
                            <li class="form-row row-12">
                                <div class="form-input contents-value-input">
                                    <input class=" @error('contents-value') is-invalid @enderror" type="text" name="contents-value" placeholder="VALUE...">
                                </div>
                            </li>
                        
                            <li class="form-row row-13">
                                <input class="cont bold button-black" type="submit" value="PROCEED">
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
<style>



</style>
@endsection

@section('styles')
@parent
<link href="{{ asset('css/personal.stage4.css') }}" rel="stylesheet">
@endsection
