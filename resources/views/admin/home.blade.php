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
  <a href="#about">About</a>
  <a href="#services">Services</a>
  <a href="#clients">Clients</a>
  <a href="#contact">Contact</a>
</div>

<div class="main">
	<div class="card">
		<h4 style="margin-top:20px;margin-bottom:20px;">Shipments</h4>
		<div id="example">
            <table id="grid">
                <colgroup>
                    <col />
                    <col />
                    <col style="width:110px" />
                    <col style="width:120px" />
                    <col style="width:130px" />
                </colgroup>
                <thead>
                    <tr>
                        <th data-field="make">Car Make</th>
                        <th data-field="model">Car Model</th>
                        <th data-field="year">Year</th>
                        <th data-field="category">Category</th>
                        <th data-field="airconditioner">Air Conditioner</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Volvo</td>
                        <td>S60</td>
                        <td>2010</td>
                        <td>Saloon</td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>Audi</td>
                        <td>A4</td>
                        <td>2002</td>
                        <td>Saloon</td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>BMW</td>
                        <td>535d</td>
                        <td>2006</td>
                        <td>Saloon</td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>BMW</td>
                        <td>320d</td>
                        <td>2006</td>
                        <td>Saloon</td>
                        <td>No</td>
                    </tr>
                    <tr>
                        <td>VW</td>
                        <td>Passat</td>
                        <td>2007</td>
                        <td>Saloon</td>
                        <td>No</td>
                    </tr>
                    <tr>
                        <td>VW</td>
                        <td>Passat</td>
                        <td>2008</td>
                        <td>Saloon</td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>Peugeot</td>
                        <td>407</td>
                        <td>2006</td>
                        <td>Saloon</td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>Honda</td>
                        <td>Accord</td>
                        <td>2008</td>
                        <td>Saloon</td>
                        <td>No</td>
                    </tr>
                    <tr>
                        <td>Alfa Romeo</td>
                        <td>159</td>
                        <td>2008</td>
                        <td>Saloon</td>
                        <td>No</td>
                    </tr>
                    <tr>
                        <td>Nissan</td>
                        <td>Almera</td>
                        <td>2001</td>
                        <td>Saloon</td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>Mitsubishi</td>
                        <td>Lancer</td>
                        <td>2008</td>
                        <td>Saloon</td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>Opel</td>
                        <td>Vectra</td>
                        <td>2008</td>
                        <td>Saloon</td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>Toyota</td>
                        <td>Avensis</td>
                        <td>2006</td>
                        <td>Saloon</td>
                        <td>No</td>
                    </tr>
                    <tr>
                        <td>Toyota</td>
                        <td>Avensis</td>
                        <td>2008</td>
                        <td>Saloon</td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>Toyota</td>
                        <td>Avensis</td>
                        <td>2008</td>
                        <td>Saloon</td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>Audi</td>
                        <td>Q7</td>
                        <td>2007</td>
                        <td>SUV</td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>Hyundai</td>
                        <td>Santa Fe</td>
                        <td>2012</td>
                        <td>SUV</td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>Hyundai</td>
                        <td>Santa Fe</td>
                        <td>2013</td>
                        <td>SUV</td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>Nissan</td>
                        <td>Qashqai</td>
                        <td>2007</td>
                        <td>SUV</td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>Mercedez</td>
                        <td>B Class</td>
                        <td>2007</td>
                        <td>Hatchback</td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>Lancia</td>
                        <td>Ypsilon</td>
                        <td>2006</td>
                        <td>Hatchback</td>
                        <td>Yes</td>
                    </tr>
                </tbody>
            </table>

	</div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/admin.home.js') }}"></script>
@endsection