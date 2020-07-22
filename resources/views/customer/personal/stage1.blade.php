@extends('layouts.customer.personal.master')

@section('content')
<main>
    <div class="container">
        <div class="quote-stage-1 bg-yellow">
            <div class="arrow-down"></div>
{{--            <h1 class="tc tc-white"><span class="bold">Send a Parcel</span></h1>--}}
{{--            <p class="tc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod<br>--}}
{{--                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.--}}
{{--            </p>--}}
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
                <p>PRICE & DELIVERY<br>OPTIONS</p>
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
                                <select class="@error('toCountryCode') is-invalid @enderror" id="to" name="toCountryCode" type="text">
                                    <option>Select a country...</option>
                                    <option value="">--------------------------</option>
                                    <option value="US">United States of America</option>
                                    <option value="">--------------------------</option>
                                    @foreach ($countries as $country)
                                        @if ($country->zone != 0)
                                            <option value="{{$country->code}}">{{$country->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('toCountryCode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </li>
                        <li class="form-row row-2">
                            <div class="row-2-left">
                                <div class="form-input weight-input">
                                    <label for="weight">WEIGHT:</label>
                                    <input class="@error('weight') is-invalid @enderror" id="weight" name="weight" type="text">
                                    <div class="unit-tag">
                                        <span class="unit-text">kg</span>
                                    </div>
                                    @error('weight')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row-2-right">
                                <div class="form-input dim-input length-input">
                                    <label for="length">LENGTH:</label>
                                    <input class="@error('length') is-invalid @enderror" id="length" name="length" type="text">
                                    <div class="unit-tag">
                                        <span class="unit-text">cm</span>
                                    </div>
                                    @error('length')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-input dim-input width-input">
                                    <label for="width">WIDTH:</label>
                                    <input class="@error('width') is-invalid @enderror" id="width" name="width" type="text">
                                    <div class="unit-tag">
                                        <span class="unit-text">cm</span>
                                    </div>
                                    @error('width')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-input dim-input height-input">
                                    <label for="height">HEIGHT:</label>
                                    <input class="@error('height') is-invalid @enderror" id="height" name="height" type="text">
                                    <div class="unit-tag">
                                        <span class="unit-text">cm</span>
                                    </div>
                                    @error('height')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </li>
                        <li class="form-row row-3">
                            <span class="bold"><i class="fas fa-plus"></i>&nbsp;WANT TO SEND ADDITIONAL PACKAGES? </span>&nbsp;&nbsp;<br><a class="business-link bold" href="#">GET A BUSINESS ACCOUNT</a>
                        </li>
                        <li class="form-row row-4">
                            <label class="cb-container">
                                <input type="checkbox" name="terms">
                                <span class="checkmark"></span>
                            </label>
                            <span class="bold terms-text">I agree to the terms and conditions which can be found <a href="#">here</a>.</span>
                        </li>
                        @error('terms')
                            <p class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </p>
                        @enderror
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
