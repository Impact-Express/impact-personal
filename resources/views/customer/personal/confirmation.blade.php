@extends('layouts.customer.personal.master')

@section('content')

<main>
    <div class="container">
        <div class="quote-complete bg-yellow">
            <div class="arrow-down"></div>
            <h1 class="tc tc-white"><span class="bold">Booking Complete</span></h1>            
        </div>
        <div class="quote-container bg-yellow">
            <div class="quote-box">
                <div class="top-line">
                    <h2>Your parcel details</h2>
                    <div class="button-container">
                        <a class="button-black" href="{{route('account')}}">Your account</a>
                        <a class="button-black" href="{{route('get-label-pdf', $shipment->id)}}" target="_blank">Get your label</a>
                    </div>
                </div>
                <div class="parcel-details">
                    <hr>
                    <p>Parcel reference: {{$shipment->shipment_reference}}</p>  
                    <hr>
                    <h4>Delivery address</h4>
                    <p>{{$shipment->consignee}}</p>
                    <p>{{$shipment->consignee_address_1}}</p>
                    <p>{{$shipment->consignee_address_2}}</p>
                    <p>{{$shipment->consignee_address_3}}</p>
                    <p>{{$shipment->consignee_city}}</p>
                    <p>{{$shipment->consignee_zip}}</p>
                    <p>{{$shipment->consignee_country_iso_code}}</p>
                    <hr>
                    <h4>Parcel details</h4>
                    <p>Contents: {{$shipment->contents}}</p>
                    <p>Value: £{{money_format('%n',$shipment->value/100)}}</p>
                    <p>Length: {{$shipment->length}}cm</p>
                    <p>Width: {{$shipment->width}}cm</p>
                    <p>Height: {{$shipment->height}}cm</p>
                    <p>Weight: {{$shipment->dead_weight/1000}}kg</p>
                    <hr>
                    <p>Price: £{{money_format('%n',$shipment->price/100)}}</p>
                </div>
            </div>
        </div>
    </div>
</main>
<style>

@media (max-width: 991px) {
    .quote-stage-2 {
        padding-bottom: 30px;
        margin-bottom: 30px;
    }
    .quote-container {
        width: 100%;
        padding: 30px 5%;
        margin-bottom: 30px;
    }
    .quote-box {
        background-color: whitesmoke;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 2% 4%;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    .carrier-logo {
        height: 100px;
    }
    .service-name {
        font-size: 20px;
    }
    .delivery-estimate {
        font-size: 15px;
    }
    .price {
        font-size: 20px;
    }
}
@media (min-width: 992px) {
    .quote-complete {
        padding-bottom: 30px;
        margin-bottom: 30px;
    }
    .quote-stage-2 {
        padding-bottom: 30px;
        margin-bottom: 30px;
    }
    .quote-container {
        width: 100%;
        padding: 100px 15%;
        margin-bottom: 30px;
    }
    .quote-box {
        background-color: whitesmoke;
        
        padding: 2% 4%;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    .top-line {
        width:100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .carrier-logo {
        height: 100px;
    }
    .service-name {
        font-size: 20px;
    }
    .delivery-estimate {
        font-size: 15px;
    }
    .price {
        font-size: 20px;
    }
}
</style>

@endsection

@section('styles')
@parent
<link href="{{ asset('css/personal.complete.css') }}" rel="stylesheet">
@endsection
