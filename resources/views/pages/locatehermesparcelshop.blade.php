@extends('layouts.customer.personal.master')

@section('content')
<div class="container">
    <iframe width="992" height="780" src="https://new.myhermes.co.uk/iframes/parcelshop-finder.html" frameborder="0" allowfullscreen></iframe>
</div>
@endsection

@section('styles')
@parent
<link href="{{ asset('css/hermesparcelshop.css') }}" rel="stylesheet">
@endsection