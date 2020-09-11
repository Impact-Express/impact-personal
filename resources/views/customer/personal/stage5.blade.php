@extends('layouts.customer.personal.master')

@section('content')
    <main>
        <div class="container">
            <div class="quote-stage-5 bg-yellow">
                <div class="arrow-down"></div>
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
                    <div class="payment-island bg-yellow">
                        <div class="bg-white">
                            <h2>Booking Summary</h2>
                            <hr>
                            <h3>Destination</h3>
                            <p>{{$shipmentData['consignee']}}</p>
                            <p>{{$shipmentData['consignee_address_1']}}</p>
                            <p>{{$shipmentData['consignee_address_2'] ?? ''}}</p>
                            <p>{{$shipmentData['consignee_address_3'] ?? ''}}</p>
                            <p>{{$shipmentData['consignee_city']}}</p>
                            <p>{{$shipmentData['consignee_country_iso_code']}}</p>
                            <p>{{$shipmentData['consignee_zip'] ?? ''}}</p>
                            <hr>
                            <h3>Contents</h3>
                            <p>{{$shipmentData['contents']}}</p>
                            <h3>Value</h3>
                            <p>£{{sprintf('%01.2f', $shipmentData['value']/100)}}</p>
                            <hr><brit isn't getting any etter>
                            <form method="POST" id="SagePayForm" action="https://test.sagepay.com/gateway/service/vspform-register.vsp">
                                <input type="hidden" name="VPSProtocol" value= "3.00">
                                <input type="hidden" name="TxType" value= "PAYMENT">
                                <input type="hidden" name="Vendor" value= "impactexpres853">
                                <input type="hidden" name="Crypt" value= "{{ $encryptedCode }}">
                                <input class="button-black" type="submit" value="Continue to payment">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="right-islands">
                    <div class="quote-island">
                        <div class="logo-circle">
                            <img src="/assets/images/circle-logo.png" alt="">
                        </div>
                        <div class="quote-body bg-white">
                            <div class="quote-content">
                                <div class="inner-quote-content">
                                    <div><span class="bold">From: </span>{{$bookingData['fromCountry']}}</div>
                                    <div><span class="bold">To: </span>{{$bookingData['toCountry']}}</div>

                                    <div><span class="bold">Weight: </span>{{$bookingData['weight']}}kg</div>
                                    <div><span class="bold">Length: </span>{{$bookingData['length']}}cm</div>
                                    <div><span class="bold">Width: </span>{{$bookingData['width']}}cm</div>
                                    <div><span class="bold">Height: </span>{{$bookingData['height']}}cm</div>
                                    <div><span class="bold">Price: </span>£{{sprintf('%01.2f',$bookingData['price'])}}</div>
                                </div>
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
<link href="{{ asset('css/personal.stage5.css') }}" rel="stylesheet">
@endsection

@section('scripts')

@endsection
