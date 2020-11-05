@extends ('layouts.app')

@section('master')
<div class="top-strip">
    <img class="top-strip-img" src="/assets/images/dhl-strip-img.png" alt="DHL Authorised Service Partner">
</div>
<nav class="main-nav">
    <a class="navbar-logo" href="{{route('stage1')}}">
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
                   <span><a href="{{route('admin.shipments')}}">Hi, {{ strtoupper(Auth::user()->firstName) }}</a>&nbsp;&nbsp;</span>
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
    <div class="sidenav">
        <a href="{{route('admin.home')}}">Home</a>
        <a href="{{route('admin.shipments')}}">Shipments</a>
        <a href="{{route('admin.customers')}}">Customers</a>
        <a href="{{route('admin.superadmin')}}">Admin</a>
    </div>
    @yield('content')

<!-- #main-footer -->
<!-- <footer id="main-footer">



</footer> -->

<style>
    th.k-header {
        padding: 16px 47px 13px 24px !important;
    }
    .sidenav {
        height: 40%;
        width: 160px;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #111;
        overflow-x: hidden;
        margin-top: 120px;
        padding-top: 30px;
    }

    .sidenav a {
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        font-size: 25px;
        color: #818181;
        display: block;
    }

    .sidenav a:hover {
        color: #f1f1f1;
    }
</style>
@endsection

@section('styles')
<link rel="stylesheet" href="{{asset('css/kendo/kendo.common.min.css')}}">
<link rel="stylesheet" href="{{asset('css/kendo/kendo.material-v2.min.css')}}">
<link href="{{ asset('css/personal.master.css') }}" rel="stylesheet">
@endsection
