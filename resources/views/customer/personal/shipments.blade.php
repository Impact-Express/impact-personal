@extends('layouts.customer.personal.master')

@section('content')

<main>
    <div class="container shipments-container bg-yellow">
        <ul>
            <li class="tab"><h2>My Shipments</h2></li>
            <li class="sep"></li>
            <li class="tab"><a class="account" href="{{route('account')}}">My Account</a></li>
        </ul>
        
        <ul>
            @forelse ($shipmentsByDate as $shipment)
                <li class="shipment-box">
                    {{$shipment->shipment_reference}}
                    <a href="{{route('get-label-pdf', $shipment->id)}}" target="_blank">Label</a>
                </li>
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
</style>
@endsection
@section('scripts')
<script src="{{ asset('js/modal.js') }}" defer></script>
@endsection
