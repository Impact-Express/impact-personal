@extends ('layouts.app')

@section('master')
<div class="top-strip">
    <img class="top-strip-img" src="/assets/images/dhl-strip-img.png" alt="DHL Authorised Service Partner">
</div>
<nav class="main-nav">
    <a class="navbar-logo" href="#">
        <img class="nav-logo-img" src="/assets/images/navbar-logo.png" alt="Impact Express Logo">
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
                   <span><a href="{{route('account')}}">Hi, {{ strtoupper(Auth::user()->firstName) }}</a>&nbsp;&nbsp;</span>
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
<!-- #main-footer -->
<!-- <footer id="main-footer">
    
    

</footer> -->





@endsection

@section('styles')
<link href="{{ asset('css/personal.master.css') }}" rel="stylesheet">
@endsection