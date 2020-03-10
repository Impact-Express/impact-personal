@extends('layouts.customer.personal.master')

@section('content')
<main>
    <div class="container">
        <div class="quote-complete bg-yellow">
            <div class="arrow-down"></div>
            <h1 class="tc tc-white"><span class="bold">Booking Complete</span></h1>
            <p class="tc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod<br>
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
            </p>
            

            
        </div>
    </div>
</main>
@endsection

@section('styles')
@parent
<link href="{{ asset('css/personal.complete.css') }}" rel="stylesheet">
@endsection
