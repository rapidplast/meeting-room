@extends('layouts.admin')
@section('content')
<div>
    <!-- @if ($message = Session::get('fail'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Failed!!</strong><span> {{ $message }}</span>
    </div>
    @elseif ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!!</strong><span> {{ $message }}</span>
    </div>
    @endif -->

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
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
                <div class="d-inline">
                    <h4>Meeting Room Reservations</h4>
                    <span>Here is the list of Reservations in Meeting Room</span>
                </div>
            </div>
        </div>
        <div class="card-header">
            <div class="card-header-right">
                <ul class="list-unstyled card-option">
                    <li><i class="icofont icofont-simple-left"></i></li>
                    <li><i class="icofont icofont-maximize full-card"></i></li>
                    <li><i class="icofont icofont-minus minimize-card"></i></li>
                    <li><i class="icofont icofont-refresh reload-card"></i></li>
                    <li><i class="icofont icofont-error close-card"></i></li>
                </ul>
            </div>
        </div>
        <div class="card-block table-border-style">
            <div id="header-content">
            <div class="d-flex mx-3 mb-3" style="justify-content: space-between !important;">
                    <div class="pcoded-search" id="search" style="width: 500px !important; display: flex; align-items: center;">
                        <label for="reservation_time" class="col-sm-3 col-form-label">Meeting Time In</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="in" placeholder="Enter Reservation Time" name="in"> 
                        </div>
                        <label for="reservation_time" class="col-sm-3 col-form-label">Meeting Time Out</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="out" placeholder="Enter Reservation Time" name="out">                                       
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary">Load Meeting</button>
                    </div>
                        <button class="btn btn-primary" onclick="showFormAddReservation(); return false;"><i class="ti-plus"></i>Add Meeting</button>
            </div>
            </div>
        </div>


            {{-- Add Data --}}
            <div class="mx-3" style="display: none;" id="formAddReservation" class="my-3">
                <center><h2 class="mb-3">Add Reservation</h2></center>
                <form method="post" action="{{ route('reservation.store') }}" id="myForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">User Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama" placeholder="Input Your Name" name="nama">
                            </div>

                            {{-- <select name="user_id" class="form-control" autofocus>
                            <option >--PILIH Nama Karyawan--</option>
                                @foreach($user as $c)
                                <option value="{{$c->user_id}}">{{$c->name}}
                                </option>
                                @endforeach

                            </select> --}}
                    </div>   

                    <div class="form-group row">
                        <label for="meeting_id" class="col-sm-3 col-form-label">Meeting Room</label>
                        <div class="col-sm-8">
                            <select name="meeting_id" id="meeting_id" class="form-control">
                                <option value="" selected disabled>===== Choose Meeting Room =====</option>
                                @foreach($meeting as $data)
                                    <option value="{{$data->meeting_id}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>
                           {{-- <div class="col-sm-8">
                                @foreach($meeting as $s)
                                <input type="radio" id="service{{$s->service_id}}" name="service_id[]" value="{{$s->service_id}}">
                                <label for="service{{$s->service_id}}">{{$s->service_id}}|{{$s->name}}</label>
                                @endforeach                            
                        </div> --}}
                    </div>
                    <div class="form-group row">
                        <label for="datee" class="col-sm-3 col-form-label">Meeting Date</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="datee" placeholder="Enter Reservation Time" name="datee">
                        </div>
                    </div>
                    <div class="d-flex mx-3 mb-3" style="justify-content: space-between !important;">
                        <label for="reservation_time" class="col-sm-3 col-form-label">Meeting Time In</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="in" placeholder="Enter Reservation Time" name="in"> 
                        </div>
                        <label for="reservation_time_out" class="col-sm-3 col-form-label">Meeting Time Out</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="out" placeholder="Enter Reservation Time" name="out">                                       
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary">Load Meeting</button>
                        </div>
                        <button class="btn btn-primary" onclick="showFormAddReservation(); return false;"><i class="ti-plus"></i>Add Meeting</button>
                    </div>
                    <div class="form-group row">
                        <label for="ket" class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="ket" placeholder="Input Reservation Description" name="ket">
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label for="ket" class="col-sm-3 col-form-label">Ket</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="ket" placeholder="Enter Reservation Time" name="ket">
                        </div>
                    </div> --}}
                    <div>
                        <a type="button"  class="btn btn-primary btn-outline-primary" onclick="hideForm()">Back</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>


            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="reservationTable">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Date</th>
                            <th>Meeting Time In</th>
                            <th>Meeting Time Out</th>
                            <th>Description</th>
                            <th>Meeting Room</th>
                            <th>User</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php 
                        use App\Models\reservationStatus;
                            $no = 1; 
                            @endphp
                        @foreach($reservation as $reservation)
                        <?php 
                        // $reservationStatus1 = reservationStatus::all();
                        ?>
                        <tr>
                            <!-- <th scope="row">{{$no++}}</th>                         -->
                            <td>{{$reservation->date}}</td>
                            <td>{{$reservation->reservation_time}}</td>
                            <td>{{$reservation->reservation_time_out}}</td>
                            <td>{{$reservation->ket}}</td>
                            <td>{{$reservation->meeting->name}}</td>
                            <td>{{$reservation->nama}}</td>
                            <td> <div id="status{{$reservation->status}}">                             
                                @if($reservation->status )
                                <div
                                style="background: rgb(74, 212, 132); color: white; padding: 7px; font-size: 12px;">
                                Done</div>
                                @else
                                <div
                                        style="background: rgb(214, 84, 84); color: white; padding: 7px; font-size: 12px;">
                                        Dipakai </div></i>
                                @endif
                            </div>
                            <div id="editStatus{{$reservation->reservation_id}}" style="display:none">
                                <form method="post"
                                    action="{{ route('reservation.update', $reservation->reservation_id) }}"
                                    style="display: flex">
                                    @csrf
                                    @method('PUT')
                                    <select style="margin-top: 5px" name="status" class="form-control">
                                        <option value="0">Dipakai</option>
                                        <option value="1">Done</option>
                                    </select>
                                    <div style="margin-top: 5px; margin-left: 10px">
                                        <button type="submit" class="btn btn-primary">Done</button>
                                        <a href="" class="btn btn-sm" onclick = "$('#editStatus{{$reservation->reservation_id}}').hide(); $('#status{{$reservation->reservation_id}}').show(); return false; ">&times;</a>
                                    </div>
                                </form>
                            </div>
                        </td>
                        
                            <td style="display: flex; justify-content: space-between">
                                <a type="button" class="btn btn-info" href=""onclick="$('#editStatus{{$reservation->reservation_id}}').show(); $('#status{{$reservation->reservation_id}}').hide(); return false; ">Status</a>
                                <a type="button" class="btn btn-warning" href="{{ route('reservation.edit', $reservation) }}">Edit</a>
                                <form style="display: none" id="deleteReservation{{$reservation->reservation_id}}" action="{{ route('reservation.destroy', $reservation->reservation_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="submit" class="btn btn-danger" onclick="document.getElementById('deleteReservation{{$reservation->reservation_id}}').submit();">Delete</button>
                                <!-- <button class="btn btn-inverse" data-toggle="modal" data-target="#reservation{{$reservation->reservation_id}}" data-toggle="tooltip" data-original-title="see detail"><i class="
                                    ti-zoom-in"></i>Show</button> -->
                            </td>
                        </tr>
                        {{-- <div class="modal fade" id="reservation{{$reservation->reservation_id}}" tabindex="-1" role="dialog" aria-labelledby="reservation{{$reservation->reservation_id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div>
                                            <h5 class="modal-title" id="exampleModalLongTitle">Detail
                                                {{$reservation->pegawai->name}}'s Reservation
                                            </h5>
                                            <h6 class="mt-3">Code Reservation: <b>{{$reservation->reservation_code}}</b></h6>
                                        </div>
                                        <a style="border-radius:5px" class="btn btn-sm btn-success" href="{{route('printReservationPDF', $reservation)}}" target="_blank" rel="noopener noreferrer">Print
                                            PDF</a>
                                    </div>
                                    <div class="modal-body">
                                        <!-- <div style="border:2px solid rgba(0,0,0,.125); padding: 10px; border-radius: 10px; margin-bottom: 15px">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Customer</h5>
                                            <div style="display: flex; justify-content: space-between">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">Name :{{$reservation->pegawai->name}}</li>
                                                    <li class="list-group-item">E-Mail :{{$reservation->customer->email}}</li>
                                                    <li class="list-group-item">Phone :{{$reservation->customer->phone}}</li>
                                                    <li class="list-group-item">Reservation Time
                                                        :{{$reservation->reservation_time}}</li>                                                        
                                                </ul>
                                                <img class="float-right my-2" width="170px" height="170px" style="border-radius: 10%" src="{{asset('storage/'.$reservation->customer->image)}}">
                                            </div>
                                        </div> -->
                                        <div style="border:2px solid rgba(0,0,0,.125); padding: 10px; border-radius: 10px; margin-bottom: 15px">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Services</h5>
                                            <div>
                                                <ul class="list-group list-group-flush">
                                                    @foreach ($reservationServices as $reservationS)
                                                    @if ($reservation->reservation_code == $reservationS->reservation_code)
                                                    <li style="display: flex; justify-content: space-between" class="list-group-item">
                                                        Service: {{$reservationS->service->name}}<br>
                                                        Price: {{$reservationS->service->price}}
                                                        <img width="50px" height="50px" style="border-radius: 10%" src="{{asset('storage/'.$reservationS->service->image)}}">
                                                    </li>
                                                    @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<style>
/* CSS untuk form edit reservation */
#formAddReservation {
    border: 1px solid #ddd; /* Menambahkan garis tepi */
    padding: 20px; /* Menambahkan padding agar form terlihat lebih lega */
    border-radius: 5px; /* Mengatur sudut elemen form */
    background-color: #f9f9f9; /* Mengatur warna latar belakang */
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Menambahkan efek bayangan */
}

#formAddReservation label {
    font-weight: bold;
    margin-top: 5px; /* Mengurangi jarak atas label */
}

/* Styling untuk kolom input */
#formAddReservation .form-control {
    margin-top: 5px; /* Mengurangi jarak atas kolom input */
}

/* Styling untuk tombol "Update" dan "Cancel" */
#formAddReservation button[type="submit"],

/* Tambahan styling sesuaikan dengan kebutuhan desain Anda */
/* Container styles */
#formAddReservation {
        border: 1px solid #ddd !important;
        padding: 20px !important;
        border-radius: 5px !important;
        background-color: #fff !important;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1) !important;
        max-width: 400px !important; /* Adjust the width as needed */
        margin: 0 auto !important; /* Center the form horizontally */
    }

    /* Form label styles */
    #formAddReservation label {
        font-weight: bold !important;
        margin-bottom: 5px !important;
    }

    /* Form input styles */
    #formAddReservation .form-control {
        margin-bottom: 15px !important;
        padding: 10px !important;
        border: 1px solid #ccc !important;
        border-radius: 4px !important;
        width: 100% !important;
    }

    /* Button styles */
    #formAddReservation button[type="submit"] {
        background-color: #007bff !important;
        color: #fff !important;
        padding: 10px 20px !important;
        border: none !important;
        border-radius: 4px !important;
        cursor: pointer !important;
    }

    #formAddReservation button[type="submit"]:hover {
        background-color: #0056b3 !important;
    }

    /* Back button style */
    #formAddReservation a.btn-primary.btn-outline-primary {
        background-color: transparent !important;
        color: #007bff !important;
        border: 1px solid #007bff !important;
        padding: 10px 20px !important;
        border-radius: 4px !important;
        text-decoration: none !important;
        margin-right: 10px !important;
    }

    #formAddReservation a.btn-primary.btn-outline-primary:hover {
        background-color: #007bff !important;
        color: #fff !important;
        border: 1px solid #007bff !important;
    }
</style>
<script>
$(document).ready(function() {
    $('#reservationTable').DataTable();
});
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/wow/wow.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
<script>
$("document").ready(function(){
    setTimeout(function(){
       $("div.alert").remove();
    }, 3000 ); 

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
<script>
function validateTimeInput(inputElement) {
    const timeRegex = /^(1[0-2]|0?[1-9]):[0-5][0-9] (AM|PM)$/i; // Format HH:MM AM/PM

    if (!inputElement.value.match(timeRegex)) {
        alert('Invalid time format. Please use HH:MM AM/PM format.');
        inputElement.value = ''; // Menghapus nilai input yang salah
        inputElement.focus(); // Memfokuskan kembali ke input yang salah
    }
}

document.getElementById('reservation_time').addEventListener('blur', function() {
    validateTimeInput(this);
});

document.getElementById('reservation_time_out').addEventListener('blur', function() {
    validateTimeInput(this);
});
</script>

@endsection