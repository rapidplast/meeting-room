@extends('layouts.admin')

@section('content')

<head>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('defaultImage/favico.png') }}">
</head>
<div>
    <!-- @if ($message = Session::get('fail'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Gagal!!</strong><span> {{ $message }}</span>
    </div>
    @elseif ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Sukses!!</strong><span> {{ $message }}</span>
    </div>
    @endif -->

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Ada beberapa masalah dengan inputan Anda.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
<div class="page-body">
    <div class="card">
        <div class="mt-3 ml-3">
            <div class="page-header-title">
                <i class="icofont icofont-table bg-c-blue"></i>
                <!-- <div class="d-inline">
                    <h4>Meeting Room Reservations</h4>
                    <span>Here is the list of Reservations in Meeting Room</span>
                </div> -->
            </div>
        </div>
        <div class="card-header-right">
            <ul class="list-unstyled card-option">
                <li><i class="icofont icofont-simple-left "></i></li>
                <li><i class="icofont icofont-maximize full-card"></i></li>
                <li><i class="icofont icofont-minus minimize-card"></i></li>
                <li><i class="icofont icofont-refresh reload-card"></i></li>
                <li><i class="icofont icofont-error close-card"></i></li>
            </ul>
        </div>
        {{-- Form Edit --}}
        <div class="mx-3 mb-3" id="formEditReservation">
            <center>
                <h2 class="mb-3">Edit Reservation</h2>
            </center>
            <form method="POST" action="{{ route('reservation.update', $reservation->reservation_id) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="reservation_id" value="{{ $reservation->reservation_id }}">

                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Plant</label>
                    <div class="col-sm-8">
                        <select name="id_plant" id="id_plant" class="form-control">
                            <option value="{{$reservation->id_plant}}" selected>{{$reservation->plant->name}}</option>
                            @foreach($plant as $data)
                            <option value="{{$data->id_plant}}">{{$data->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">User Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama" placeholder="Input Your Name" name="nama" value="{{ $reservation->nama }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="meeting_id" class="col-sm-3 col-form-label">Meeting Room</label>
                    <div class="col-sm-8">
                        <select name="meeting_id" id="meeting_id" class="form-control">
                            @foreach($meeting as $data)
                            <option value="{{$data->meeting_id}}" @if($reservation->meeting_id == $data->meeting_id) selected @endif>{{$data->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="date" class="col-sm-3 col-form-label">Meeting Date</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="date" placeholder="Enter Reservation Time" name="date" value="{{ $reservation->date }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="reservation_time" class="col-sm-3 col-form-label">Meeting Time In</label>
                    <div class="col-sm-8">
                        <input type="time" class="form-control" id="reservation_time" placeholder="Enter Reservation Time" name="reservation_time" value="{{ date('H:i',strtotime($reservation->reservation_time)) }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="reservation_time_out" class="col-sm-3 col-form-label">Meeting Time Out</label>
                    <div class="col-sm-8">
                        <input type="time" class="form-control" id="reservation_time_out" placeholder="Enter Reservation Time" name="reservation_time_out" value="{{ date('H:i',strtotime($reservation->reservation_time_out))}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ket" class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="ket" placeholder="Input Reservation Description" name="ket" value="{{ $reservation->ket }}">
                    </div>
                </div>
                <div style="text-align: center;">
                    <a type="button" href="{{ route('reservation.index',['id_plant' => $reservation->id_plant]) }}" class="btn btn-primary" onclick="hideForm()" style="background-color: #fff; color: #dc3545; border-color: #dc3545; margin-right: 10px; width: 100px; height: 40px;">Back</a>
                    <button type="submit" class="btn btn-primary" style="margin-left: 10px; width: 100px; height: 40px;">Update</button>
                </div>
            </form>
        </div>
    </div>
    <style>
        /* CSS untuk form edit reservation */
        #formEditReservation {
            border: 1px solid #ddd;
            /* Menambahkan garis tepi */
            padding: 20px;
            /* Menambahkan padding agar form terlihat lebih lega */
            border-radius: 5px;
            /* Mengatur sudut elemen form */
            background-color: #f9f9f9;
            /* Mengatur warna latar belakang */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            /* Menambahkan efek bayangan */
        }

        #formEditReservation label {
            font-weight: bold;
            margin-top: 5px;
            /* Mengurangi jarak atas label */
        }

        /* Styling untuk kolom input */
        #formEditReservation .form-control {
            margin-top: 5px;
            /* Mengurangi jarak atas kolom input */
        }

        /* Styling untuk tombol "Update" dan "Cancel" */
        #formEditReservation button[type="submit"],

        /* Tambahan styling sesuaikan dengan kebutuhan desain Anda */
    </style>
    <style>
        /* Container styles */
        #formEditReservation {
            border: 1px solid #ddd !important;
            padding: 20px !important;
            border-radius: 5px !important;
            background-color: #fff !important;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1) !important;
            width: 800px !important; /* Adjust the width as needed */
            margin: 0 auto !important; /* Center the form horizontally */
            margin-bottom: 30px !important;
        }

        /* Form label styles */
        #formEditReservation label {
            font-weight: bold !important;
            margin-bottom: 5px !important;
        }

        /* Form input styles */
        #formEditReservation .form-control {
            margin-bottom: 15px !important;
            padding: 10px !important;
            border: 1px solid #ccc !important;
            border-radius: 4px !important;
            width: 100% !important;
        }
        
    </style>
    <script>
        function reloadPage() {
            window.location.reload();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $("document").ready(function() {
            setTimeout(function() {
                $("div.alert").remove();
            }, 3000);
        });
    </script>
    <script>
        function showFormAddReservation() {
            console.log('OK')
            var formAdd = document.getElementById('formAddReservation');
            var csTable = document.getElementById('reservationTable');
            var header = document.getElementById('header-content')
            console.log(header)
            if (formAdd.style.display === "none") {
                formAdd.style.display = "";
                csTable.style.display = "none";
                header.style.display = "none";
            } else {
                formAdd.style.display = "none";
                csTable.style.display = "";
                header.style.display = "block";
            }
        }

        function hideForm() {
            console.log('OK')
            var formAdd = document.getElementById('formAddReservation');
            var csTable = document.getElementById('reservationTable');
            var header = document.getElementById('header-content')
            if (formAdd.style.display === "") {
                formAdd.style.display = "none";
                csTable.style.display = "";
                header.style.display = "";
            }
        }
    </script>

    @endsection