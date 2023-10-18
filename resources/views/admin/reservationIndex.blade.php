    @extends('layouts.admin')
    @section('content')
    <div>

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
                    <div class="d-inline" style="text-align:center">
                        <h2>Meeting Room Reservations</h2>
                    </div>
                </div>
            
                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li><i class="icofont icofont-simple-left"></i></li>
                        <li><i class="icofont icofont-maximize full-card"></i></li>
                        <li><i class="icofont icofont-minus minimize-card"></i></li>
                        <li><i class="icofont icofont-refresh reload-card"></i></li>
                        <li><i class="icofont icofont-error close-card"></i></li>
                    </ul>
                </div>

                <!-- <div id="header-content">
                <div class="d-flex mx-3 mb-3" style="justify-content:space-between !important">
                    <div class="pcoded-search" id="search" style="width: 500px !important;">
                        <span class="searchbar-toggle"></span>
                        <form method="GET" action="{{ route('reservation.index') }}">
                            @csrf
                            <div class="pcoded-search-box d-flex">
                                <label for="reservation_time" class="col-sm-3 col-form-label">Meeting Time In</label>                                                                                                               
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="in" placeholder="Enter Reservation Time" name="in"> 
                                </div>
                                <label for="reservation_time" class="col-sm-3 col-form-label">Meeting Time Out</label>
                                <div class="col-sm-4">
                                <input type="date" class="form-control" id="out" placeholder="Enter Reservation Time" name="out">
                                
                            </div>     
                            
                            <div>                                
                                <button type="submit" class="btn btn-primary">Load Meeting</button>
                                <a href="{{ route('reservation.index', ['showAll' => 1]) }}" class="btn btn-primary">All Data</a>
                            </div>
                        </form>
                    </div></div>
                </div> -->
            </div>
                {{-- Add Data --}}
                <div class="mx-3" style="display: none;" id="formAddReservation">
                    <h4 class="mb-3" style="text-align:center";>Add Reservation</h4>
                    <form method="post" action="{{ route('reservation.store') }}" id="myForm" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Plant</label>
                                <div class="col-sm-8">
                                    <select name="id_plant" id="id_plant" class="form-control">
                                    <option value="" selected disabled>===== Choose Plant =====</option>
                                    @foreach($plant as $data)
                                        <option value="{{$data->id_plant}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                                </div>

                                <!-- {{-- <select name="user_id" class="form-control" autofocus>
                                <option >--PILIH Nama Karyawan--</option>
                                    @foreach($user as $c)
                                    <option value="{{$c->user_id}}">{{$c->name}}
                                    </option>
                                    @endforeach

                                </select> --}} -->
                        </div> 

                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">User Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nama" placeholder="Input Your Name" name="nama">
                                </div>
<!-- 
                                {{-- <select name="user_id" class="form-control" autofocus>
                                <option >--PILIH Nama Karyawan--</option>
                                    @foreach($user as $c)
                                    <option value="{{$c->user_id}}">{{$c->name}}
                                    </option>
                                    @endforeach

                                </select> --}} -->
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
                            <!-- {{-- <div class="col-sm-8">
                                    @foreach($meeting as $s)
                                    <input type="radio" id="service{{$s->service_id}}" name="service_id[]" value="{{$s->service_id}}">
                                    <label for="service{{$s->service_id}}">{{$s->service_id}}|{{$s->name}}</label>
                                    @endforeach                            
                            </div> --}} -->
                        </div>
                        <div class="form-group row">
                            <label for="datee" class="col-sm-3 col-form-label">Meeting Date</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="date" placeholder="Enter Reservation Time" name="date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="reservation_time" class="col-sm-3 col-form-label">Meeting Time In</label>
                            <div class="col-sm-8">
                                <input type="time" class="form-control" id="reservation_time" placeholder="Enter Reservation Time" name="reservation_time">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="reservation_time_out" class="col-sm-3 col-form-label">Meeting Time Out</label>
                            <div class="col-sm-8">
                                <input type="time" class="form-control" id="reservation_time_out" placeholder="Enter Reservation Time" name="reservation_time_out">
                            </div>
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
                        <div style="text-align: center;"> <!-- Tambahkan gaya text-align untuk mengatur posisi horizontal -->
                            <a type="button" class="btn btn-primary" onclick="hideForm()" style="background-color: #fff; color: #dc3545; border-color: #dc3545; margin-right: 10px; width: 100px; height: 40px;">Back</a>
                            <button type="submit" class="btn btn-primary" style="margin-left: 10px; width: 100px; height: 40px;">Submit</button>
                        </div>
                    </form>
                </div>


                {{-- Table --}}
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="reservationTable">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>No</th>
                                <th>Plant</th>
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

                            @php use App\Models\reservationStatus;
                                $no = 1; 
                                @endphp
                            @foreach($reservations as $reservation)
                            <?php 
                            // $reservationStatus1 = reservationStatus::all();
                            ?>
                            <tr>
                                <th scope="row">{{$no++}}</th>  
                                <td>{{$reservation->plant->name}}</td>                      
                                <td>{{$reservation->date}}</td>
                                <td>{{date('H:i',strtotime($reservation->reservation_time))}}</td>
                                <td>{{date('H:i',strtotime($reservation->reservation_time_out))}}</td>
                                <td>{{$reservation->ket}}</td>
                                <td>{{$reservation->meeting->name}}</td>
                                <td>{{$reservation->nama}}</td>
                                <td> <div id="status{{$reservation->status}}">                             
                                    @if($reservation->status )
                                    <div
                                    style="background: grey; color: white; padding: 7px; font-size: 16px; text-align: center;">Used</div>
                                    @else
                                    <div style="background: mediumseagreen ; color: white; padding: 7px; font-size: 16px; text-align: center; "> Done </div></i>
                                    @endif
                                </div>
                            
                                <td style="display: flex; justify-content: center;">
                                    <a type="button" class="btn btn-primary mx-2" href="{{ route('reservation.edit', $reservation->reservation_id) }}" style="background-color: #02245B; color: white;">Update</a>
                                    <form action="{{ route('reservation.destroy', $reservation->reservation_id) }}" method="post" id="deleteReservation{{$reservation->reservation_id}}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger mx-2 delete-button" data-form-id="deleteReservation{{$reservation->reservation_id}}" style="background-color: #a20d0d; color: white;">Delete</button>
                                    </form>
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
    <!-- Calendar will be rendered here -->
    <div id='calendar'></div>
    <!-- Calendar will be rendered here -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Ambil data reservasi aktif Anda dalam format JSON
            var activeReservations = {!! json_encode($reservations) !!};

            // Ubah data reservasi menjadi format event yang sesuai
            var events = activeReservations.map(function (reservation) {
                return {
                    title: 'Meeting Room ' + reservation.meeting.meeting_id,
                    start: reservation.reservation_time, // Tanggal dan waktu mulai reservasi
                    end: reservation.reservation_time_out, // Tanggal dan waktu selesai reservasi
                    is_used: 1, // Anda dapat menambahkan properti tambahan sesuai kebutuhan
                };
            });

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridDay',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'timeGridDay,timeGridWeek,dayGridMonth'
                },
                events: events, // Gunakan array events yang sudah dibuat
                eventClick: function (info) {
                    // Tambahkan logika ketika event di klik (opsional)
                    alert('Ruang ' + info.event.title + ' Diklik');
                },
                eventContent: function (arg) {
                    var content = document.createElement('div');
                    content.innerText = 'Meeting Room' + arg.event.title;

                    // Tambahkan class 'used-room' untuk ruangan yang digunakan
                    if (arg.event.extendedProps.is_used === 1) {
                        content.classList.add('used-room');

                        // Tambahkan status ruangan ke dalam elemen
                        var statusElement = document.createElement('div');
                        statusElement.innerHTML = 'Used';
                        statusElement.classList.add('room-status');
                        content.appendChild(statusElement);
                    }

                    return { domNodes: [content] };
                }
            });
            
            calendar.render();
        });
        
    </script>

    <style>
        /* Mengatur tepi tabel */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        /* Mengatur kolom "Action" menjadi tengah */
        th:last-child, td:last-child {
            text-align: center;
        }
        .btn-action {
            width: 200px !important; /* Sesuaikan ukuran yang Anda inginkan */
            text-align: center;
        }
    </style>
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

    </style> 
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
    import Swal from 'sweetalert2'; // Impor SweetAlert2 di sini

function confirmDelete(formId) {
    Swal.fire({
        title: 'Apakah Anda yakin ingin menghapus data ini?',
        text: 'Data ini akan dihapus secara permanen',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'Cancel',
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    var deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            confirmDelete(button.dataset.formId);
        });
    });
});
 
</script>

<!-- <script>
    function loadMeeting() {
        var meetingTimeIn = document.getElementById('in').value;
        var meetingTimeOut = document.getElementById('out').value;

        // Lakukan permintaan AJAX untuk mengambil data meeting berdasarkan tanggal
        // Anda perlu menyesuaikan ini dengan endpoint atau cara Anda mengambil data dari server
        // Misalnya, Anda bisa menggunakan jQuery AJAX atau JavaScript Fetch API

        // Contoh penggunaan JavaScript Fetch API:
        fetch('/api/meetings?start_date=' + meetingTimeIn + '&end_date=' + meetingTimeOut)
            .then(response => response.json())
            .then(data => {
                // Manipulasi tabel atau tampilkan hasil pencarian sesuai data yang diterima
                // Anda bisa menggunakan JavaScript untuk memperbarui tabel atau tampilan
                console.log(data); // Data yang diterima dari server
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script> -->

<script>
    function searchMeetings() {
        var searchCriteria = document.getElementById('search').value;

        // Lakukan permintaan AJAX untuk mencari data meeting berdasarkan kriteria pencarian
        fetch('/api/meetings?search=' + searchCriteria)
            .then(response => response.json())
            .then(data => {
                // Manipulasi tabel atau tampilkan hasil pencarian sesuai data yang diterima
                // Anda bisa menggunakan JavaScript untuk memperbarui tabel atau tampilan
                console.log(data); // Data yang diterima dari server
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function checkReservationStatus() {
        // Ambil pesan refresh jika ada
        const refreshMessage = "{!! session('refresh_message') ?? '' !!}";

        // Periksa jika ada pesan refresh, tampilkan SweetAlert
        if (refreshMessage) {
            Swal.fire({
                icon: 'info',
                title: 'Perhatian!',
                text: refreshMessage,
                showConfirmButton: true,
            });
        }
    }

    // Panggil fungsi checkReservationStatus saat halaman dimuat
    window.addEventListener('load', checkReservationStatus);
</script>

<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Fungsi untuk menangani perubahan status
    function handleReservationStatusChange(event) {
        const data = JSON.parse(event.data);

        // Tampilkan SweetAlert jika reservasi telah selesai
        Swal.fire({
            icon: 'info',
            title: 'Perhatian!',
            text: data.message,
            showConfirmButton: true,
        });
    }

    const eventSource = new EventSource("/sse");

    // Mendengarkan perubahan status
    eventSource.onmessage = handleReservationStatusChange;
</script> -->
<style>
    /* Container styles */
    #formAddReservation {
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
    
</style>

@endsection