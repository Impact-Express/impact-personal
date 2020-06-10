@extends('layouts.customer.personal.master')

@section('content')

<main>
    <div class="container shipments-container bg-yellow">
        <ul>
            <li class="tab"><a class="account" href="{{route('shipments')}}">My Shipments</a></li>
            <li class="sep"></li>
            <li class="tab"><a class="account" href="{{route('account')}}">My Account</a></li>
            <li class="sep"></li>
            <li class="tab"><h2>Security</h2></li>
        </ul>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{route('change-password')}}" method="POST">
            @csrf
            <ul class="form-rows">
                <li class="form-row">
                    <input class="@error('current-password') is-invalid @enderror" type="password" name="current-password" placeholder="CURRENT PASSWORD...">
                    @error('current-password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </li>
                <li class="form-row">
                    <input class=" @error('new-password') is-invalid @enderror" type="password" name="new-password" placeholder="NEW PASSWORD...">
                    @error('new-password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </li>
                <li class="form-row">
                    <input class=" @error('new-password-confirmation') is-invalid @enderror" type="password" name="new-password_confirmation" placeholder="CONFIRM NEW PASSWORD...">
                    @error('new-password-confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </li>
                <li class="form-row">
                    <button type="submit" class="button-black">
                        Change Password
                    </button>
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
<link href="{{ asset('css/changepassword.css') }}" rel="stylesheet">
@endsection
