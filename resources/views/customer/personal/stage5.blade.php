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
                    <div class="payment-island bg-yellow">
                        <div class="payment-container bg-white">
                            
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
<link href="{{ asset('css/personal.stage5.css') }}" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://www.paypal.com/sdk/js?client-id={{$paypalClientId}}&currency=GBP"></script>
<script>
    paypal.Buttons({  
        createOrder: function() {
            return fetch("{{route('paypal-create')}}", {
                method: "post",
                headers: {
                    "content-type": "application/json"
                },
                body: JSON.stringify({
                    _token: "{{ csrf_token() }}"
                })
            }).then(function(res) {
                return res.json();
            }).then(function(data) {
                console.log("data1",data);
                return data.id;
            });
        },
        onApprove: function(data, actions) {
            console.log("data2",data);
            return fetch("{{route('paypal-capture')}}", {
                method: 'post',
                headers: {
                    "content-type": "application/json"
                },
                body: JSON.stringify({
                    _token: "{{ csrf_token() }}",
                    orderID: data.orderID
                })
            }).then(function(res) {
                return res.json();
            }).then(function(details) {
                console.log("data3",details);
                if (details.error === "INSTRUMENT_DECLINED") {
                    return actions.restart();
                }
                window.location.replace("{{route('complete')}}");
            });
        }
    }).render(".payment-container");
</script>
@endsection
