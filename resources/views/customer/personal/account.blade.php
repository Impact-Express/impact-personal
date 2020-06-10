@extends('layouts.customer.personal.master')

@section('content')
<main>
    <div class="container shipments-container bg-yellow">
        <ul>
            <li class="tab"><a class="account" href="{{route('shipments')}}">My Shipments</a></li>
            <li class="sep"></li>
            <li class="tab"><h2>My Account</h2></li>
            <li class="sep"></li>
            <li class="tab"><a class="account" href="{{route('change-password-form')}}">Security</a></li>
        </ul>
        <form action="{{route('update-user')}}" method="POST">
            @csrf
            <ul class="form-rows">
                <li class="form-row">
                    <select class="bg-white @error('title') is-invalid @enderror" type="text" name="title">
                        <option class="title-option" value="">TITLE...</option>
                        <option class="title-option" value="Mr" {{$user->title == 'Mr'? 'selected' : ''}}>Mr</option>
                        <option class="title-option" value="Miss" {{$user->title == 'Miss'? 'selected' : ''}}>Miss</option>
                        <option class="title-option" value="Mrs" {{$user->title == 'Mrs'? 'selected' : ''}}>Mrs</option>
                    </select>
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </li>
                <li class="form-row">
                    <input class="@error('firstName') is-invalid @enderror" type="text" name="firstName" placeholder="FIRST NAME..." value="{{$user->firstName}}">
                    @error('firstName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </li>
                <li class="form-row">
                    <input class=" @error('lastName') is-invalid @enderror" type="text" name="lastName" placeholder="LAST NAME..." value="{{$user->lastName}}">
                    @error('lastName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </li>
                <li class="form-row">
                    <input class=" @error('email') is-invalid @enderror" type="email" name="email" placeholder="EMAIL ADDRESS..." value="{{$user->email}}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </li>
                <li class="form-row">
                    <input class=" @error('phone') is-invalid @enderror" type="text" name="phone" placeholder="PHONE NO..." value="{{$user->phone}}">
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </li>
                <!-- <li class="form-row">
                    <input id="buildingName" name="buildingName" type="text" placeholder="BUILDING NAME..." value="{{$user->building_name}}">
                </li>
                <li class="form-row">
                    <input id="buildingNumber" name="buildingNumber" type="text" placeholder="BUILDING NUMBER..."  value="{{$user->building_number}}">
                </li> -->
                <li class="form-row">
                    <input id="line1" name="addressLine1" type="text" placeholder="ADDRESS LINE 1..." value="{{$user->address_line_1}}">
                </li>
                <li class="form-row">
                    <input id="line2" name="addressLine2" type="text" placeholder="ADDRESS LINE 2..." value="{{$user->address_line_2}}">
                </li>
                <li class="form-row">
                    <input id="line3" name="addressLine3" type="text" placeholder="ADDRESS LINE 3..." value="{{$user->address_line_3}}">
                </li>
                <li class="form-row">
                    <input id="town"  name="city" type="text" placeholder="CITY" value="{{$user->city}}">
                </li>
                <li class="form-row">
                    <input id="county"  name="county" type="text" placeholder="COUNTY" value="{{$user->county}}">
                </li>
                <li class="form-row">
                    <input id="country" name="countryISOcode" type="text" Value="United Kingdom" placeholder="COUNTRY" readonly>
                </li>
                <li class="form-row">
                    <input id="postcode" name="postcode" type="text" placeholder="POSTCODE" value="{{$user->postcode}}">
                </li>
                <li class="form-row">
                    <input class="cont bold button-black" type="submit" value="SAVE">
                </li>
            </ul>
        </form>
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
    .title-option {
        color: black;
    }
</style>
@endsection
@section('styles')
@parent
<link href="{{ asset('css/personal.account.css') }}" rel="stylesheet">
@endsection