@extends('layouts.admin.master')

@section('content')
<style>

.card {
    margin: 20px;
    padding: 1px 15px 15px 15px;
    background: whitesmoke;
    border-radius: 5px;
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

.main {
  margin-left: 160px; /* Same as the width of the sidenav */
  font-size: 28px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>

<div class="sidenav">
  <a href="{{route('admin.shipments')}}">Shipments</a>
  <a href="#admin">Admin</a>
  <!-- <a href="#clients">Clients</a>
  <a href="#contact">Contact</a> -->
</div>

<div class="main">
	<div class="card">

	</div>
</div>
@endsection
