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

.ref {
  cursor: pointer;
}

/* The Modal (background) */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
    background-color: #fefefe;
    margin: 10% auto; /* 10% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 50%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button */
    .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    }

    .close:hover,
    .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
    }

    .modalBtn {
        background: none;
        border: none;
        cursor:pointer;

    }

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>

<div class="sidenav">
  <a href="{{route('admin')}}">Shipments</a>
  <a href="{{route('customers')}}">Customers</a>
  <a href="#admin">Admin</a>
</div>

<div class="main">
	<div class="card">
		<h4 style="margin-top:20px;margin-bottom:20px;">Shipments</h4>
		<div id="example">
            <table id="grid">
                <colgroup>
                    <col />
                    <col />
                </colgroup>
                <thead>
                    <tr>
                        <th data-field="ref">Shipment Ref</th>
                        <th data-field="sender">Sender</th>
                    </tr>
                </thead>
                <tbody>
                	@forelse ($shipments as $shipment)
						<tr>
							<td><button class="ref modalBtn" data-ref="{{$shipment->shipment_reference}}">{{$shipment->shipment_reference}}</button></td>
							<td>{{$shipment->user->email}}</td>
						</tr>
					@empty
            		@endforelse
                </tbody>
            </table>
		</div>
	</div>
</div>

@forelse ($shipments as $shipment)
  <!-- MODAL -->
  <div id="modal-{{$shipment->shipment_reference}}" class="modal">
	<!-- Modal content -->
	<div class="modal-content">
		<span class="close" id='close-{{$shipment->shipment_reference}}'>&times;</span>
		<p>{{$shipment->shipment_reference}}</p>
		<p>{{$shipment->consignee}}</p>
		<p>{{$shipment->consignee_address_1}}</p>
		<p>{{$shipment->consignee_address_2}}</p>
		<p>{{$shipment->consignee_address_3}}</p>
		<p>{{$shipment->consignee_city}}</p>
		<p>{{$shipment->consignee_zip}}</p>
		<p>{{$shipment->consignee_country_iso_code}}</p>
		<p>{{$shipment->contents}}</p>
		<p>£{{money_format('%n',$shipment->value/100)}}</p>
		<p>{{$shipment->length}}cm</p>
		<p>{{$shipment->width}}cm</p>
		<p>{{$shipment->height}}cm</p>
		<p>{{$shipment->dead_weight/1000}}kg</p>
	</div>
</div>
<!-- END MODAL -->
@empty
@endforelse

@endsection

@section('scripts')
<script src="{{ asset('js/admin.home.js') }}"></script>
<script src="{{ asset('js/modal.js') }}" defer></script>
@endsection
