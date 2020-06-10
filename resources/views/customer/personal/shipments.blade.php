@extends('layouts.customer.personal.master')

@section('content')

<main>
    <div class="container shipments-container bg-yellow">
        <ul>
            <li class="tab"><h2>My Shipments</h2></li>
            <li class="sep"></li>
            <li class="tab"><a class="account" href="{{route('account')}}">My Account</a></li>
            <li class="sep"></li>
            <li class="tab"><a class="account" href="{{route('change-password-form')}}">Security</a></li>
        </ul>
        
        <ul>
            @forelse ($shipmentsByDate as $shipment)
                <li class="shipment-box">
                    <button class="modalBtn" id="details-{{$shipment->shipment_reference}}" data-ref="{{$shipment->shipment_reference}}">{{$shipment->shipment_reference}}</button>
                    <a href="{{route('get-label-pdf', $shipment->id)}}" target="_blank">Get Label</a>
                </li>
                <!-- MODAL -->
                    <div id="modal-{{$shipment->shipment_reference}}" class="modal">
                        <!-- Modal content -->
                        <div class="modal-content">
                            <span class="close" id='close-{{$shipment->shipment_reference}}'>&times;</span>
                            <p>{{$shipment->shipment_reference}}</p>
                            <p>{{$shipment->consignee}}</p>
                            <p>{{$shipment->consignee_address_1}}</p>
                            <p>{{$shipment->consignee_address_2}}</p>
                            <p>{{$shipment->consignee_address_3}}</p>
                            <p>{{$shipment->consignee_city}}</p>
                            <p>{{$shipment->consignee_zip}}</p>
                            <p>{{$shipment->consignee_country_iso_code}}</p>
                            <p>{{$shipment->contents}}</p>
                            <p>£{{money_format('%n',$shipment->value/100)}}</p>
                            <p>{{$shipment->length}}cm</p>
                            <p>{{$shipment->width}}cm</p>
                            <p>{{$shipment->height}}cm</p>
                            <p>{{$shipment->dead_weight/1000}}kg</p>
                        </div>
                    </div>
                <!-- END MODAL -->
            @empty
            You haven't sent any parcels yet!
            @endforelse
        </ul>
    </div>
</main>

<style>
    ul {
        padding-left: 0;
    }
    .shipments-container {
        width: 100%;
        padding: 100px 15%;
        margin-bottom: 30px;
        margin-top: 30px;
    }
    .shipment-box {
        background-color: whitesmoke;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 2% 4%;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        margin-bottom: 10px;
    }
    ul {
        list-style-type: none;
    }
    li {
        display: inline-block;
    }
    .tab {
        padding: 0 10px;
    }
    .sep {
        border: 1px solid black;
        height:20px;
        width:3px;
        background: black;
    }
    .account {
        text-decoration: underline;
    }



    /* The Modal (background) */
    .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
    background-color: #fefefe;
    margin: 10% auto; /* 10% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 50%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button */
    .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    }

    .close:hover,
    .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
    }

    .modalBtn {
        background: none;
        border: none;
        cursor:pointer;

    }



</style>
@endsection
@section('scripts')
<script src="{{ asset('js/modal.js') }}" defer></script>
@endsection
