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
  <a href="{{route('admin')}}">Shipments</a>
  <!-- <a href="#services">Services</a>
  <a href="#clients">Clients</a>
  <a href="#contact">Contact</a> -->
</div>

<div class="main">
	<div class="card">
		<h4 style="margin-top:20px;margin-bottom:20px;">Shipments</h4>
		<div id="example">
            <table id="grid">
                <colgroup>
                    <col />
                </colgroup>
                <thead>
                    <tr>
                        <th data-field="ref">Shipment Ref</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shipments as $shipment)
					<tr>
                        <td>{{$shipment->shipment_reference}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

	</div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/admin.home.js') }}"></script>
@endsection