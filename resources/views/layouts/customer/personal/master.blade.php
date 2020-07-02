@extends ('layouts.app')

@section('master')
<div class="top-strip">
    <img class="top-strip-img" src="/assets/images/dhl-strip-img.png" alt="DHL Authorised Service Partner">
</div>
<nav class="main-nav">
    <a class="nav-logo" href="{{route('stage1')}}">
        <img class="nav-logo-img" src="/assets/images/logo01.svg" alt="Impact Express Logo">
    </a>
    <div class="hamburger-container">
        <button class="hamburger button-square" type="button">
            <span class="hamburger-icon"><i class="fas fa-bars"></i></span>
        </button>
    </div>
    <ul class="nav-items">
        <li class="nav-item">
            <a class="nav-link" href="#">Navigation Tab 1</a>
        </li>
        <li class="nav-dropdown">
            <a class="nav-link" href="#">Navigation Tab 2</a>
        </li>
        <li class="nav-dropdown">
            <a class="nav-link" href="#">Navigation Tab 3</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Navigation Tab 4</a>
        </li>
        <!-- Authentication Links -->
        @guest
            <li class="nav-item">
                <a class="nav-link button-main" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link button-main" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown loggedin">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                   <span><a href="{{route('shipments')}}">Hi, {{ strtoupper(Auth::user()->firstName) }}</a>&nbsp;&nbsp;</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item button-main" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
</nav>
    @yield('content')
    <div class="mobile-nav">
    <ul class="mobile-nav-items">
        <li class="mobile-nav-img">
            <a href=""><img class="mobile-logo" src="{{asset('assets/images/logo01.svg')}}" alt="Impact Express Logo"></a>
        </li>
        <li class="mobile-nav-item"><a href="{{route('stage1')}}">Send a Parcel</a></li>
        <li class="mobile-nav-img"></li>
        <li class="mobile-nav-item"><a href="https://impactexpress.co.uk/tracking/">Track My Parcel</a></li>
        <li class="mobile-nav-item"><a href="https://impactexpress.co.uk/services/">Services</a></li>
        <li class="mobile-nav-item"><a href="https://impactexpress.co.uk/information/">News & Events</a></li>
        <li class="mobile-nav-item"><a href="https://impactexpress.co.uk/services/international-shipping-destinations/">Shipping Destinations</a></li>
        <li class="mobile-nav-img"></li>
        <li class="mobile-nav-item"><a href="https://impactexpress.co.uk/contactus/">Contact Us</a></li>
        <li class="mobile-nav-img"></li>
        @guest
            <li class="mobile-nav-item">Login</li>
            <li class="mobile-nav-item">Sign up</li>
        @else
            <li class="mobile-nav-item"><a  href="{{route('account')}}">Account</a></li>
            <li class="mobile-nav-item">
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
            </li>
        @endguest
    </ul>
</div>
<!-- #main-footer -->
<!-- <footer id="main-footer">
</footer> -->
@endsection

@section('styles')
<link href="{{ asset('css/personal.master.css') }}" rel="stylesheet">
@endsection
