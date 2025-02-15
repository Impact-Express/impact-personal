@extends('layouts.admin.master')

@section('content')
    <style>

        .card {
            margin: 20px;
            padding: 1px 15px 15px 15px;
            background: whitesmoke;
            border-radius: 5px;
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

        ul {
            list-style-type: none;
        }
        .charge-item {
            display: flex;
            justify-content: space-between;
            width: 50%;
            margin-bottom: 20px;
            border-bottom: 1px solid #0da394;
            padding: 5px;
        }
    </style>

    <div class="main">
        <div class="card">
            <h4 style="margin-top:20px;margin-bottom:20px;">SuperAdmin</h4>
            <span style="font-size:20px;color:red;">Danger zone! These options affect pricing on the site.</span>
        </div>
        <div class="card">
            <h4 style="margin-top:20px;margin-bottom:20px;">Charges</h4>
            <ul>
                @foreach($surcharges as $sc)
                    <li class="charge-item">{{$sc->display_name .": ".sprintf($sc->format, $sc->value)}} <button class="k-button modalBtn" data-ref="{{$sc->id}}">Change</button> </li>
                @endforeach
            </ul>
        </div>
        <div class="card">
            <h4 style="margin-top:20px;margin-bottom:20px;">Update DHL Tariff</h4>
            <form action="{{route('tariff.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input class="k-button" type="file" name="file" required>
                <button class="k-button">Update</button>
            </form>
        </div>
        <div class="card">
            <h4 style="margin-top:20px;margin-bottom:20px;">Admin Users</h4>
            <div id="example">
                <table id="grid">
                    <colgroup>
                        <col />
                        <col />
                    </colgroup>
                    <thead>
                    <tr>
                        <th data-field="cust">User</th>
                        <th data-field="actions">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($admins as $admin)
                        <tr>
                            <td><button class="ref modalBtn" data-ref="admin{{$admin->id}}">{{$admin->email}}</button></td>
                            @if ($admin->id != auth()->id())
                                <td><button class="k-button modalBtn" style="background-color:red;color:white;" data-ref="admin-toggle{{$admin->id}}">Revoke Admin</button></td>
                            @endif
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @forelse ($surcharges as $sc)
        <!-- MODAL -->
        <div id="modal-{{$sc->id}}" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="close" id='close-{{$sc->id}}'>&times;</span>
                <h4>{{$sc->display_name}}</h4>
                <p>Warning! Changing this will affect pricing on the website.</p>
                <form action="{{route($sc->route)}}" method="POST" style="display:flex;justify-content:space-between;">
                    @csrf
                    <input type="text" value="{{$sc->value}}" name={{$sc->name}}>
                    <span>
                        <button class="close-{{$sc->id}} k-button" type="button">Cancel</button>
                        <button class="k-button" style="background:#ff0000;color:#ffffff;font-weight:bolder;">Submit</button>
                    </span>
                </form>
            </div>
        </div>
        <!-- END MODAL -->
    @empty
    @endforelse

    @forelse ($admins as $a)
        <!-- MODAL -->
        <div id="modal-admin{{$a->id}}" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="close" id='close-admin{{$a->id}}'>&times;</span>
                <p><span>{{$a->title}}</span>&nbsp;<span>{{$a->firstName}}</span>&nbsp;<span>{{$a->lastName}}</span></p>
                <p><span>{{$a->email}}</span></p>
                @if (isset($a->building_name)) <p><span>{{$a->building_name}}</span></p> @endif
                @if (isset($a->building_number)) <p><span>{{$a->building_number}}</span></p> @endif
                @if (isset($a->address_line_1)) <p><span>{{$a->address_line_1}}</span></p> @endif
                @if (isset($a->address_line_2)) <p><span>{{$a->address_line_2}}</span></p> @endif
                @if (isset($a->address_line_3)) <p><span>{{$a->address_line_3}}</span></p> @endif
                @if (isset($a->city)) <p><span>{{$a->city}}</span></p> @endif
                @if (isset($a->county)) <p><span>{{$a->county}}</span></p> @endif
                @if (isset($a->country_id)) <p><span>{{$a->countryName()}}</span></p> @endif
                @if (isset($a->postcode)) <p><span>{{$a->postcode}}</span></p> @endif
            </div>
        </div>
        <div id="modal-admin-toggle{{$a->id}}" class="modal">
            <div class="modal-content">
                <form action="{{route('admin.revoke')}}" method="POST">
                    <span class="close" id="close-admin-toggle{{$a->id}}">&times;</span>
                    <div>Really revoke admin access?</div>
                    <br>
                    @csrf
                    <input name="userId" type="hidden" value="{{$a->id}}" required>
                    <button class="close-admin-toggle{{$a->id}} k-button" type="button">Cancel</button>
                    <button class="k-button" style="background-color:red;color:white;">Yes, revoke</button>
                </form>
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
