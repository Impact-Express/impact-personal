@extends('layouts.customer.personal.master')

@section('content')
<div class="container bg-yellow">
    <div class="register-form-container">
        <form action="{{route('register')}}" method="POST">
            @csrf
                
                
                    <ul class="form-rows">
                        <li class="form-row row-1">
                            <div class="form-input title-input @error('title') is-invalid @enderror">
                                <input type="text" name="title">
                            </div>
                            <div class="form-input firstname-input @error('firstName') is-invalid @enderror">
                                <input type="text" name="firstName" placeholder="FIRST NAME...">
                            </div>
                            <div class="form-input lastname-input @error('lastName') is-invalid @enderror">
                                <input type="text" name="lastName" placeholder="LAST NAME...">
                            </div>
                        </li>
                        <li class="form-row row-2">
                            <div class="form-input su-email-input @error('email') is-invalid @enderror">
                                <input type="text" name="email" placeholder="EMAIL ADDRESS...">
                            </div>
                            <div class="form-input phone-input @error('phone') is-invalid @enderror">
                                <input type="text" name="phone" placeholder="PHONE NO...">
                            </div>
                        </li>
                        <li class="form-row row-3">
                            <div class="form-input su-password-input @error('password') is-invalid @enderror">
                                <input type="text" name="password" placeholder="ENTER A PASSWORD...">
                            </div>
                            <div class="form-input password-confirm-input">
                                <input type="text" name="password_confirmation" placeholder="CONFIRM PASSWORD...">
                            </div>
                        </li>
                        <li class="form-row row-4">
                            <div class="form-input address-input">
                                <input type="text" name="address" placeholder="ENTER A POSTCODE TO FIND ADDRESS...">
                            </div>
                            <input class="bold button-grey" type="submit" value="FIND ADDRESS">
                        </li>
                        <li class="form-row row-5">
                            <label class="cb-container">
                                <input type="checkbox">
                                <span class="checkmark"></span>
                                Terms and conditions blah blah blah
                            </label>
                        </li>
                        <li class="form-row row-6">
                            <input class="cont bold button-black" type="submit" value="REGISTER">
                        </li>
                    </ul>
                
        </form>
    </div>
</div>
@endsection

@section('styles')
@parent
<link href="{{ asset('css/register.css') }}" rel="stylesheet">
@endsection