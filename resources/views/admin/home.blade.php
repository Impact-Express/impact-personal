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
    </style>

    <div class="main">
        <div class="card">
            <h4 style="margin-top:20px;margin-bottom:20px;">Admin Dashboard</h4>

        </div>
    </div>
@endsection

@section('scripts')
    {{--    <script src="{{ asset('js/admin.home.js') }}"></script>--}}
    {{--    <script src="{{ asset('js/modal.js') }}" defer></script>--}}
@endsection
