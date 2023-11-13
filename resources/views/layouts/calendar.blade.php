<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/defaultImage/favico.png') }}">
    <title>Reservation</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('public/js/main.js') }}"></script>
    <link href="{{ asset('public/img/favicon.ico') }}" rel="icon">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <link href="{{ asset('public/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="{{ asset('public/css/style.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="path-to-your-main.js"></script>
</head>
<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-dark px-0">
        <div class="row g-0 d-none d-lg-flex">
            <div class="col-lg-4 ps-5 text-start">
                <div class="h-100 d-inline-flex align-items-center text-white">
                    <span></span>
                    <a class="btn btn-link text-light" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-link text-light" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-link text-light" href=""><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-link text-light" href=""><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <!-- Running Text
                <div class="navbar-running-text" style="color: white; font-family: impact; font-size:22px; text-shadow: 2px 2px #a20d0d;">
                    <marquee class="navbar-running-text" behavior="scroll" direction="left" scrollamount="3"  onmouseover="this.stop()" onmouseout="this.start()"> -->
                        <!-- @php
                        $activeReservationssd = \App\Models\Reservation::where('status', 1)->get();
                        $activeRooms = $activeReservationssd->isNotEmpty() ? "Meeting Rooms Currently in Use: " : 'No Meeting Rooms are Currently in Use.';

                        if ($activeReservationssd->isNotEmpty()) {
                            $activeRoomNumbers = $activeReservationssd->pluck('meeting.meeting_id')->unique();
                            foreach ($activeRoomNumbers as $roomNumber) {
                                $activeRooms .= "Meeting Room $roomNumber, ";
                            }
                            $activeRooms = rtrim($activeRooms, ', '); // Menghapus koma terakhir
                        }
                        @endphp
                        {{ $activeRooms }} -->
                    <!-- </marquee>
                </div> -->
            </div>
            <div class="col-lg-4 text-end">
                <div class="h-100 topbar-right d-inline-flex align-items-center text-white py-2 px-5">
                    <span class="fs-5 fw-bold me-2"><i class="fa fa-phone-alt me-2"></i>Call Us:</span>
                    <span class="fs-5 fw-bold">(031)8436669</span>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top py-0 pe-5">
        <a href="calendar?id_plant" class="navbar-brand ps-5 me-0" style="background-color: #FFFFFF;">
            <img src="{{ asset('public/img/RapidPlast.png') }}" alt="Logo Rapid">
        </a>
        <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="/meeting-room" class="nav-item nav-link">Home</a>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Calendar</h1>
                </div>
            </div>
            <div class="card-body">
                <div id='calendar'></div>
        </div>
    </div>
    
    <style>
    .fc-event-title {
        font-size: 18px;
        margin-top: 0px;
        font-family: sans-serif;
        padding: 0px 0px;
        border-radius: 5px;
    }
    .fc-day-today {
        background-color: #f0f0f0 !important;
    }
    .fc-event-main {
        border-color: #f0f0f0 !important;
    }
    .fc-event-title.used-room {
        background-color: #ff0000;
        color: white;
    }
    .done-room {
        color: white;
        background-color: #A9A9A9 !important;
    }
    .custom-btn-style {
        background-color: #a20d0d !important; 
        color: #fff !important; 
    }
    .custom-icon-style {
        background-color: #a20d0d !important;
    }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
    var activeReservations = {!! json_encode($activeReservations) !!};
    var events = activeReservations.map(function (reservation) {
        var plantId = reservation.id_plant;
        var roomNumber = reservation.meeting.meeting_id;
        var roomStatus = 'Digunakan';
        var tooltip = "Meeting Room " + roomNumber + " (Plant " + plantId + " - " + roomStatus + ")";

        var rt = reservation.reservation_time;
        const datess = new Date(rt);
        const hour = datess.getHours();
        const minutes = datess.getMinutes();
        let newdates = new Date(reservation.date);
        newdates.setHours(hour);
        newdates.setMinutes(minutes);
        let newdatesOut = new Date(reservation.date);
        let rto = reservation.reservation_time_out;
        const [hours, minutess, secondss] = rto.split(":").map(Number);
        newdatesOut.setHours(hours);
        newdatesOut.setMinutes(minutess);
        return {
            title: roomNumber,
            start: newdates,
            end: newdatesOut,
            tooltip: tooltip,
            is_used: 1,
            status: reservation.status, // Tambahkan status ruang pertemuan ke dalam events
            nama: reservation.nama, // Tambahkan informasi user
            ket: reservation.ket // Tambahkan informasi deskripsi ruangan meeting
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
            var event = info.event;
            var title = event.title;
            var status = event.extendedProps.status === 0 ? 'Done' : 'Used';
            var nama = event.extendedProps.nama;
            var ket = event.extendedProps.ket;

            var message = '<strong>Meeting Room ' + title + '</strong><br>';
            message += 'Status : ' + status + '<br>';
            message += 'User : ' + nama + '<br>';
            message += 'Keterangan : ' + ket;

            Swal.fire({
                html: message,
                icon: 'info',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'custom-btn-style' ,
                    iconButton: 'custom-icon-style',
                }
            });
        },

        eventContent: function (arg) {
            var content = document.createElement('div');
            content.innerText = 'Meeting Room ' + arg.event.title;
            content.classList.add('fc-event-title');

            if (arg.event.status === 0) {
                content.classList.add('done-room');
                var statusElement = document.createElement('div');
                statusElement.innerHTML = '';
                statusElement.classList.add('room-status');
                content.appendChild(statusElement);
            } else if (arg.event.extendedProps.is_used === 1) {
                content.classList.add('used-room');
                var statusElement = document.createElement('div');
                statusElement.innerHTML = '';
                statusElement.classList.add('room-status');
                content.appendChild(statusElement);
            }

            return { domNodes: [content] };
        }
    });

    calendar.render();
});
</script>
</body>
</html>