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
        <div class="page-body"> <div class="card"> <div class="mt-3 ml-3">
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
            </div>

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
                    <input type="time" class="form-control" id="reservation_time" placeholder="Enter Reservation Time"
                        name="reservation_time">
                </div>
            </div>
            <div class="form-group row">
                <label for="reservation_time_out" class="col-sm-3 col-form-label">Meeting Time Out</label>
                <div class="col-sm-8">
                    <input type="time" class="form-control" id="reservation_time_out" placeholder="Enter Reservation Time"
                        name="reservation_time_out">
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
            <div style="text-align: center;">
                <a type="button" class="btn btn-primary" onclick="hideForm()"
                    style="background-color: #fff; color: #dc3545; border-color: #dc3545; margin-right: 10px; width: 100px; height: 40px;">Back</a>
                <button type="submit" class="btn btn-primary"
                    style="margin-left: 10px; width: 100px; height: 40px;">Submit</button>
            </div>
            </form>
        </div>
        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="reservationTable">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>No</th>
                        <th class="styled-header">Plant</th>
                        <th class="styled-header">Date</th>
                        <th>Meeting Time In</th>
                        <th>Meeting Time Out</th>
                        <th>Description</th>
                        <th>Meeting Room</th>
                        <th class="styled-header">User</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @php use App\Models\reservationStatus;
                    $no = 1;
                    @endphp
                    @foreach($reservations as $reservation)
                    <tr>
                        <th scope="row">{{$no++}}</th>
                        <td>{{$reservation->plant->name}}</td>
                        <td>{{$reservation->date}}</td>
                        <td>{{date('H:i',strtotime($reservation->reservation_time))}}</td>
                        <td>{{date('H:i',strtotime($reservation->reservation_time_out))}}</td>
                        <td>{{$reservation->ket}}</td>
                        <td>{{$reservation->meeting->name}}</td>
                        <td>{{$reservation->nama}}</td>
                        <td>
                            <div id="status{{$reservation->status}}">
                                @if($reservation->status )
                                <div
                                    style="background: grey; color: white; padding: 7px; font-size: 16px; text-align: center;">
                                    Used</div>
                                @else
                                <div
                                    style="background: mediumseagreen ; color: white; padding: 7px; font-size: 16px; text-align: center; ">
                                    Done </div></i>
                                @endif
                            </div>

                        <td style="display: flex; justify-content: center;">
                            <a type="button" class="btn btn-primary mx-2"
                                href="{{ route('reservation.edit', $reservation->reservation_id) }}"
                                style="background-color: #02245B; color: white;">Update</a>
                            <form action="{{ route('reservation.destroy', $reservation->reservation_id) }}" method="post"
                                id="deleteReservation{{$reservation->reservation_id}}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger mx-2 delete-button"
                                    data-form-id="deleteReservation{{$reservation->reservation_id}}"
                                    style="background-color: #a20d0d; color: white;">Delete</button>
                            </form>
                        </td>

                    </tr>
                    {{-- <div class="modal fade" id="reservation{{$reservation->reservation_id}}" tabindex="-1"
                    role="dialog" aria-labelledby="reservation{{$reservation->reservation_id}}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div>
                                    <h5 class="modal-title" id="exampleModalLongTitle">Detail
                                        {{$reservation->pegawai->name}}'s Reservation
                                    </h5>
                                    <h6 class="mt-3">Code Reservation: <b>{{$reservation->reservation_code}}</b></h6>
                                </div>
                                <a style="border-radius:5px" class="btn btn-sm btn-success"
                                    href="{{route('printReservationPDF', $reservation)}}" target="_blank"
                                    rel="noopener noreferrer">Print
                                    PDF</a>
                            </div>
                            <div class="modal-body">
                                <div
                                    style="border:2px solid rgba(0,0,0,.125); padding: 10px; border-radius: 10px; margin-bottom: 15px">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Services</h5>
                                    <div>
                                        <ul class="list-group list-group-flush">
                                            @foreach ($reservationServices as $reservationS)
                                            @if ($reservation->reservation_code == $reservationS->reservation_code)
                                            <li style="display: flex; justify-content: space-between"
                                                class="list-group-item">
                                                Service: {{$reservationS->service->name}}<br>
                                                Price: {{$reservationS->service->price}}
                                                <img width="50px" height="50px" style="border-radius: 10%"
                                                    src="{{asset('storage/'.$reservationS->service->image)}}">
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
        </div>
        @endforeach
        </tbody>
        </table>
    </div>
    <div id='calendar'></div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var activeReservations = {!! json_encode($reservations)!!};
        var events = activeReservations.map(function (reservation) {
            return {
                title: 'Meeting Room ' + reservation.meeting.meeting_id,
                start: reservation.reservation_time,
                end: reservation.reservation_time_out,
                is_used: 1,
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
            events: events,
            eventClick: function (info) {
                alert('Ruang ' + info.event.title + ' Diklik');
            },
            eventContent: function (arg) {
                var content = document.createElement('div');
                content.innerText = 'Meeting Room' + arg.event.title;

                if (arg.event.extendedProps.is_used === 1) {
                    content.classList.add('used-room');

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
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th:last-child,
        td:last-child {
            text-align: center;
        }

        .btn-action {
            width: 200px !important;
            text-align: center;
        }
    </style>
    <style>
        #formAddReservation {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        #formAddReservation label {
            font-weight: bold;
            margin-top: 5px;
        }
        #formAddReservation .form-control {
            margin-top: 5px;
        }
        #formAddReservation button[type="submit"]
        /* Tambahan styling sesuaikan dengan kebutuhan desain Anda */
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        $("document").ready(function () {
            setTimeout(function () {
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
    <script>
        function searchMeetings() {
            var searchCriteria = document.getElementById('search').value;
            fetch('/api/meetings?search=' + searchCriteria)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
    <style>
        #formAddReservation {
            border: 1px solid #ddd !important;
            padding: 20px !important;
            border-radius: 5px !important;
            background-color: #fff !important;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1) !important;
            width: 800px !important;
            margin: 0 auto !important;
            margin-bottom: 30px !important;
        }
        #formAddReservation label {
            font-weight: bold !important;
            margin-bottom: 5px !important;
        }
        #formAddReservation .form-control {
            margin-bottom: 15px !important;
            padding: 10px !important;
            border: 1px solid #ccc !important;
            border-radius: 4px !important;
            width: 100% !important;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        var showAlert = true;
        function checkReservationStatus() {
            const refreshMessage = "{!! session('refresh_message') ?? '' !!}";
            if (refreshMessage && showAlert) {
                Swal.fire({
                    icon: 'info',
                    title: 'Perhatian!',
                    text: refreshMessage,
                });
                setTimeout(function() {
                    hideAlertAndRedirect();
                }, 2000);
            }
        }

        function hideAlertAndRedirect() {
            showAlert = false;
            Swal.close();
        }
        window.addEventListener('load', checkReservationStatus);
        function hideAlert() {
            showAlert = false;
        }
    </script>

    <script>
        @if (Session::has('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ Session::get('success') }}',
        });
        hideAlert();
        @endif

        @if (Session::has('fail'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ Session::get('fail') }}',
        });
        hideAlert();
        @endif
    </script>

    <script>
            function autoRefresh() {
                location.reload();
            }
            setInterval(autoRefresh, 600000);
            document.addEventListener("DOMContentLoaded", function() {
                var now = new Date();
                var reservations = {!! json_encode($reservations) !!};
                reservations.forEach(function(reservation) {
                    var timeOut = new Date(reservation.reservation_time_out);
                    if (timeOut < now) {
                        reservation.status = 0;
                    }
                });
            });
        </script>

        <style>
            #reservationTable th:nth-child(2),
            #reservationTable th:nth-child(3),
            #reservationTable th:nth-child(7) {
                white-space: nowrap;
            }
            #reservationTable td:nth-child(2),
            #reservationTable td:nth-child(3),
            #reservationTable td:nth-child(7) {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 150px;
            }
            #reservationTable th:nth-child(2) {
                max-width: 100px;
            }
            #reservationTable th:nth-child(3) {
                max-width: 150px;
            }
            #reservationTable th:nth-child(7) {
                max-width: 150px;
            }
        </style>
        <style>
            #reservationTable th:nth-child(4), #reservationTable th:nth-child(5) {
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            max-width: none;
        }
        </style>
    @endsection