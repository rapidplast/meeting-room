<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/defaultImage/favico.png') }}">
        <title>Reservation</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('public/css/style.css') }}" rel="stylesheet">
        <script src="{{ asset('public/js/main.js') }}"></script>
        <!-- Favicon -->
        <link href="public/img/favicon.ico" rel="icon">
        
        <!-- tabel -->
        <!-- <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet"> -->
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Rubik:wght@500;600;700&display=swap"rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

        <!-- new js -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

        <!-- DataTables CSS dan JS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

        <!-- Libraries Stylesheet -->
        <link href="public/lib/animate/animate.min.css" rel="stylesheet">
        <link href="public/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="public/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="public/css/style.css" rel="stylesheet">
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>

    </head>

<body>

       <!-- Topbar Start -->
       <div class="container-fluid bg-dark px-0">
            <div class="row g-0 d-none d-lg-flex">
                <div class="col-lg-4 ps-5 text-start">
                    <div class="h-100 d-inline-flex align-items-center text-white">
                        <span>Follow Us:</span>
                        <a class="btn btn-link text-light" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-link text-light" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-link text-light" href=""><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-link text-light" href=""><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                <!-- Running Text -->
                <div class="navbar-running-text" style="color: white; font-family: impact; font-size:22px; text-shadow: 2px 2px #a20d0d;">
                    </div>
                </div>

                <div class="col-lg-4 text-end">
                    <div class="h-100 topbar-right d-inline-flex align-items-center text-white py-2 px-5">
                        <span class="fs-5 fw-bold me-2"><i class="fa fa-phone-alt me-2"></i>Call Us:</span>
                        <span class="fs-5 fw-bold" id="phoneNumber" onclick="copyPhoneNumber()">(031)8436669</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar End -->


        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top py-0 pe-5">
            <a href="/" class="navbar-brand ps-5 me-0" style="background-color: #FFFFFF;">
                <img src="{{ asset('public/img/RapidPlast.png') }}" alt="Logo Rapid">
            </a>
            <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="/meeting-room" class="nav-item nav-link {{ request()->is('/meeting-room') ? 'active' : '' }}">Home</a>
                    <a href="#" class="nav-item nav-link {{ request()->is('reservation') ? 'active' : '' }}">Meeting Reservation</a>
                    <a href="#" class="nav-item nav-link {{ request()->is('reservation/create') ? 'Active' : '' }}" onclick="showFormAddReservation(); return false;"><i class="ti-plus"></i>Add Reservation</a>
                    </div>
                    <div class="my-3" style="text-align: center;">
            </div>
            
            </div>
        </nav>
        <!-- Navbar End -->

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    {{-- <nav class="pcoded-navbar"> --}}
                        {{-- <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu"> --}}
                            {{-- <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Menu</div> --}}

                            {{-- <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu"> --}}
                                    {{-- <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-receipt"></i></span>
                                        <span class="pcoded-mtext"
                                            data-i18n="nav.basic-components.main">Reservation</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a> --}}
                                    {{-- <ul class="pcoded-submenu">
                                        <li class=" "> --}}
                                            {{-- <a href="{{route('reservation.index')}}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext"
                                                    data-i18n="nav.basic-components.alert">Reservation</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a> --}}
                                        {{-- </li>
                                        <li class=" "> --}}
                                            {{-- <a href="{{url('reservationStatus')}}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext"
                                                    data-i18n="nav.basic-components.breadcrumbs">Reservation
                                                    Status</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a> --}}
                                        {{-- </li>
                                    </ul>
                                </li> --}}
                                <!-- {{-- <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-hand-open"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Service</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class=" ">
                                            <a href="{{route('categoryService.index')}}">
                                                <span class=" pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext"
                                                    data-i18n="nav.basic-components.alert">Service Category</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="{{url('service')}}">
                                                <span class=" pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext"
                                                    data-i18n="nav.basic-components.breadcrumbs">Service</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </li> --}}
                                {{-- <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-id-badge"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">User</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class=" ">
                                            <a href="{{route('admins.index')}}">
                                                <span class=" pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext"
                                                    data-i18n="nav.basic-components.alert">Admin</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="{{route('customer.index')}}">
                                                <span class=" pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext"
                                                    data-i18n="nav.basic-components.breadcrumbs">Customer</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </li> --}}
                                {{-- <li class="pcoded">
                                    <a href="{{url('employee')}}">
                                        <span class=" pcoded-micon"><i class="ti-pin2"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Employee</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="pcoded">
                                    <a href="{{url('gallery')}}">
                                        <span class=" pcoded-micon"><i class="ti-gallery"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Gallery</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="pcoded">
                                    <a href="{{url('message')}}">
                                        <span class=" pcoded-micon"><i class="ti-comment"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Message</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li> --}}
                                {{-- <li class="pcoded">
                                    <a href="{{url('calendar')}}">
                                        <span class=" pcoded-micon"><i class="ti-calendar"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Calendar</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul> --}}
                            {{-- <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Login</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded">
                                    <a href="{{route('login')}}">
                            <span class="pcoded-micon"><i class="ti-key"></i><b>D</b></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Login</span>
                            <span class="pcoded-mcaret"></span>
                            </a>
                            </li>
                            </ul> --}}
                        {{-- </div> --}} -->
                    {{-- </nav> --}}
                    
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">

                            <div class="main-body">
                                <div class="page-wrapper">
                                    @yield('content')
                                </div>
                            </div>
                            <div id="styleSelector">

                            </div>
                        </div>
                    </div>
                </div>
            </div> 

        </div>
    </div>
    <!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="{{asset('public/assets/assetsAdmin/js/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/assetsAdmin/js/jquery-ui/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/assetsAdmin/js/popper.js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/assetsAdmin/js/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{asset('public/assets/assetsAdmin/js/jquery-slimscroll/jquery.slimscroll.js')}}">
    </script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{asset('public/assets/assetsAdmin/js/modernizr/modernizr.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/assetsAdmin/js/modernizr/css-scrollbars.js')}}"></script>
    {{-- FullCalendar --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- classie js -->
    <script type="text/javascript" src="{{asset('assets/assetsAdmin/js/classie/classie.js')}}"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="{{asset('public/assets/assetsAdmin/js/script.js')}}"></script>
    <script src="{{asset('public/assets/assetsAdmin/js/pcoded.min.js')}}"></script>
    <script src="{{asset('public/assets/assetsAdmin/js/demo-12.js')}}"></script>
    <script src="{{asset('public/assets/assetsAdmin/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="public/lib/wow/wow.min.js"></script>
    <script src="public/lib/easing/easing.min.js"></script>
    <script src="public/lib/waypoints/waypoints.min.js"></script>
    <script src="public/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="public/lib/counterup/counterup.min.js"></script>

    <!-- Template Javascript -->
    <script src="public/js/main.js"></script>

    <script type="text/javascript" src="public/assets/DataTables/media/js/jquery.js"></script>
    <script type="text/javascript" src="public/assets/DataTables/media/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="public/assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="public/assets/DataTables/media/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="public/assets/DataTables/media/css/dataTables.bootstrap.css">


    
    <!-- Sweet aalert update -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        // Setelah pembaruan berhasil, tampilkan SweetAlert
        @if (Session::has('success'))
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ Session::get('success') }}',
            showConfirmButton: false, // Hapus tombol OK
            timer: 2000 // Menutup SweetAlert setelah 2 detik
        });
        @endif
    </script>

<script>
   $(document).ready(function() {
       $('#reservationTable').DataTable({
           columnDefs: [
               { targets: [7], searchable: false, orderable: false } // Adjusted the target column index
           ],
           dom: 'lBfrtip',
           buttons: [
               {
                   extend: 'copyHtml5',
                   exportOptions: {
                       modifier: {
                           page: 'current'
                       },
                       columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                   }
               },
               {
                   extend: 'excelHtml5',
                   exportOptions: {
                       modifier: {
                           page: 'current'
                       },
                       columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                   }
               },
               {
                   extend: 'pdfHtml5',
                   exportOptions: {
                       modifier: {
                           page: 'current'
                       },
                       columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                   }
               },
               'colvis'
           ], 
       });
   });
</script>

<script>
    function copyPhoneNumber() {
        // Pilih elemen dengan id 'phoneNumber'
        var phoneNumberElement = document.getElementById('phoneNumber');

        // Buat elemen input teks untuk menyalin teks
        var tempInput = document.createElement('input');

        // Set nilai input dengan teks dari elemen telepon
        tempInput.value = phoneNumberElement.innerText;

        // Tambahkan elemen input ke dalam dokumen
        document.body.appendChild(tempInput);

        // Pilih teks dalam elemen input
        tempInput.select();

        // Salin teks ke clipboard
        document.execCommand('copy');

        // Hapus elemen input yang telah ditambahkan
        document.body.removeChild(tempInput);

        // Tampilkan pesan bahwa teks telah disalin
        alert('Nomor telepon telah disalin: ' + tempInput.value);
    }
</script>

<!-- <script>
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
</script> -->

</body>

</html>