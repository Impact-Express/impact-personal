@extends('layouts.customer.personal.master')

@section('content')
<main>
    <div class="container">
        <div class="quote-stage-3 bg-yellow">
            <div class="arrow-down"></div>
{{--            <h1 class="tc tc-white"><span class="bold">Send a Parcel</span></h1>--}}
{{--            <p class="tc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod<br>--}}
{{--                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.--}}
{{--            </p>--}}
            <div class="progress">
                <div class="stage-border tick">
                    <div class="stage-number"><i class="fas fa-check"></i></div>
                </div>
                <div class="stage-line"></div>
                <div class="stage-border tick">
                    <div class="stage-number"><i class="fas fa-check"></i></div>
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
                <p>PRICE & DELIVETY<br>OPTIONS</p>
                <p>SETUP ACCOUNT<br>OR LOGIN</p>
                <p>ADDRESS DETAILS</p>
                <p>PAYMENT OPTIONS</p>
            </div>
        </div>
        <div class="island-container">
            <div class="left-islands">
                <div class="login-island-container bg-yellow">
                    <h3 class="tc-white">ALREADY HAVE AN ACCOUNT?</h3>
                    <form class="login-form" action="{{ route('login-from-stage-3') }}" method="POST">
                        @csrf
                        <div class="form-input email-input">
                            <input class="@error('login-email') is-invalid @enderror" id="login-email" name="login-email" type="email" placeholder="EMAIL ADDRESS..." autocomplete="email" value="{{old('login-email')}}">
                        </div>
                        <div class="form-input password-input">
                            <input class="@error('login-password') is-invalid @enderror" id="login-password" name="login-password" type="text" placeholder="PASSWORD...">
                        </div>
                        <input class="bold button-black" type="submit" value="LOGIN">
                    </form>
                    <p><a class="pw-reset-link" href="#">Forgot your password?</a></p>
                    <p class="error-container">
                        @if(Session::get('loginError') !== null)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ Session::get('loginError') }}</strong>
                            </span>
                        @endif
                    </p>
                </div>
                <div class="signup-island-container bg-yellow">
                    <h3 class="tc-white">ACCOUNT SETUP</h3>
                    <form action="{{route('register')}}" method="POST">
                        @csrf
                        <ul class="form-rows">
                            <li class="form-row row-1">
                                <div class="form-input title-input">
                                    <select style="color:grey;" class="bg-white @error('title') is-invalid @enderror" type="text" name="title">
                                        <option class="title-option" value="">TITLE...</option>
                                        <option class="title-option" value="Mr">Mr</option>
                                        <option class="title-option" value="Miss">Miss</option>
                                        <option class="title-option" value="Mrs">Mrs</option>
                                    </select>
                                </div>
                                <style>
                                    .title-option {
                                        color: black;
                                    }
                                </style>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-input firstname-input">
                                    <input class="@error('firstName') is-invalid @enderror" type="text" name="firstName" placeholder="FIRST NAME..." value="{{old('firstName')}}">
                                </div>
                                @error('firstName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-input lastname-input">
                                    <input class=" @error('lastName') is-invalid @enderror" type="text" name="lastName" placeholder="LAST NAME..." value="{{old('lastName')}}">
                                </div>
                                @error('lastName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </li>
                            <li class="form-row row-2">
                                <div class="form-input su-email-input">
                                    <input class=" @error('email') is-invalid @enderror" type="text" name="email" placeholder="EMAIL ADDRESS..." value="{{old('email')}}">
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-input phone-input">
                                    <input class=" @error('phone') is-invalid @enderror" type="text" name="phone" placeholder="PHONE NO..." value="{{old('phone')}}">
                                </div>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </li>
                            <li class="form-row row-3">
                                <div class="form-input su-password-input">
                                    <input class=" @error('password') is-invalid @enderror" type="text" name="password" placeholder="ENTER A PASSWORD...">
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-input password-confirm-input">
                                    <input class=" @error('password_confirmation') is-invalid @enderror" type="text" name="password_confirmation" placeholder="CONFIRM PASSWORD...">
                                </div>
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </li>
                            <li class="form-row row-4">
                                <div id="p-lookup"></div>
                            </li>
                            <li class="form-row row-5">
                                <label class="cb-container">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <span class="bold terms-text">I agree to the terms and conditions which can be found <a href="#">here</a>.</span>
                            </li>
                            <li class="form-row row-6">
                                <input class="cont bold button-black" type="submit" value="REGISTER">
                            </li>
                        </ul>
                        <input id="buildingName" name="buildingName" type="hidden">
                        <input id="buildingNumber" name="buildingNumber" type="hidden">
                        <input id="line1" name="addressLine1" type="hidden">
                        <input id="line2" name="addressLine2" type="hidden">
                        <input id="line3" name="addressLine3" type="hidden">
                        <input id="town"  name="city" type="hidden">
                        <input id="county"  name="county" type="hidden">
                        <input id="country" name="countryISOcode" type="hidden" Value="GB">
                        <input id="postcode" name="postcode" type="hidden">
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
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://getaddress-cdn.azureedge.net/scripts/jquery.getAddress-3.0.2.min.js"></script>
<script>

$('#p-lookup').getAddress({
    api_key:'wkn4y_4C3ku4UvSZpaMasA25478',
    output_fields:{
        building_name: '#buildingName',
        building_number: '#buildingNumber',
        line_1: '#line1',
        line_2: '#line2',
        line_3: '#line3',
        post_town: '#town',
        county: '#county',
        postcode: '#postcode'
    },
    button_class: "bold button-grey find-address-button",
    input_class: "postcode-box",
    dropdown_class: "address-dropdown",
    // input_label: "ENTER A UK POSTCODE"
});

</script>
@endsection

@section('styles')
@parent
<link href="{{ asset('css/personal.stage3.css') }}" rel="stylesheet">
@endsection
