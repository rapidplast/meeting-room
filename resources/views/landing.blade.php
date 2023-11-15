<!DOCTYPE html>
    <html lang="en">
    <?php $plant = \App\Models\Plant::all();?>

    <head>
        <meta charset="utf-8">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/defaultImage/favico.png') }}">
        <title>Home Meeting</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('public/css/style.css') }}" rel="stylesheet">
        <script src="{{ asset('public/js/main.js') }}"></script>
        <link href="public/img/favicon.ico" rel="icon">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600x&family=Rubik:wght@500;600;700&display=swap"rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
        <link href="public/lib/animate/animate.min.css" rel="stylesheet">
        <link href="public/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="public/css/bootstrap.min.css" rel="stylesheet">
        <link href="public/css/style.css" rel="stylesheet">
        <style>
            .btn-primary {
                background-color: #a20d0d;
                border-color: #a20d0d;
            }

            .btn-primary:hover {
                background-color: #a20d0d;
                border-color: #a20d0d;
            }
        </style>

        <style>
            .dropdown {
                position: relative;
                display: inline-block;
            }
            .dropdown a {
                color: #000000;
                padding: 8px 16px;
                background: transparent;
                border: none;
                cursor: pointer;
                transition: background-color 0.2s;
                position: relative;
            }
            .dropdown a:hover {
                color: #ffffff;
            }
            .dropdown-indicator::after {
                content: '\25BC';
                font-size: 0.8em;
                margin-left: 5px;
            }
            .dropdown-menu {
                display: none;
                position: absolute;
                background-color: #ffffff;
                border: 1px solid #808080;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                z-index: 1;
            }
            .dropdown:hover .dropdown-menu {
                display: block;
            }
            .dropdown-menu .dropdown-item {
                color: #000000;
                padding: 8px 16px;
                text-decoration: none;
                display: block;
                transition: background-color 0.2s;
            }
            .dropdown-menu .dropdown-item:hover {
                background-color: #a20d0d;
                color: #ffffff;
            }
        </style>

    </head>

    <body>
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
        </div>
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
                <div class="navbar-running-text" style="color: white; font-family: impact; font-size:22px; text-shadow: 2px 2px #a20d0d;">
                    <marquee behavior="scroll" direction="left" scrollamount="3">
                        Welcome To Meeting Room Website Rapid Plast Indonesia
                    </marquee>
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
        <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top py-0 pe-5">
            <a href="/meeting-room" class="navbar-brand ps-5 me-0" style="background-color: #FFFFFF;">
                <img src="{{ asset('public/img/RapidPlast.png') }}" alt="Logo Rapid">
            </a>
            <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="/meeting-room" class="nav-item nav-link active">Home</a>
                <div class="dropdown">
                    <a class="nav-item nav-link" href="#" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                        Meeting Reservation <i class="dropdown-indicator"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <?php foreach ($plant as $value) { ?>
                        <li><a class="dropdown-item" href="{{ route('reservation.index',['id_plant' => $value->id_plant]) }}">{{$value->name}}</a></li>
                    <?php } ?>
                    </ul>
                </div>
                <div class="dropdown">
                    <a class="nav-item nav-link" href="#" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">
                        Calendar <i class="dropdown-indicator"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                    <?php foreach ($plant as $value) { ?>
                        <li><a class="dropdown-item" href="{{ route('calendar', ['id_plant' => $value->id_plant]) }}">{{$value->name}}</a></li>
                    <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        </nav>
        <div class="container-fluid px-0 mb-5">
            <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="w-100" src="public/img/rpd1.jpg" alt="Image">
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-10 text-start">
                                        <p class="fs-5 fw-medium text-primary text-uppercase animated slideInRight">Rapid Plast Indonesia</p>
                                        <h1 class="display-1 text-white mb-5 animated slideInRight">To Be Asia's Leading</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="w-100" src="public/img/rpd2.jpg" alt="Image">
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-10 text-start">
                                        <p class="fs-5 fw-medium text-primary text-uppercase animated slideInRight">Rapid Plast Indonesia</p>
                                        <h1 class="display-1 text-white mb-5 animated slideInRight">Total Solutions</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="w-100" src="public/img/grup.jpg" alt="Image">
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-10 text-start">
                                        <p class="fs-5 fw-medium text-primary text-uppercase animated slideInRight">Rapid Plast Indonesia</p>
                                        <h1 class="display-1 text-white mb-5 animated slideInRight">Packaging & Plastic Provider</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-6">
                        <div class="row gx-3 h-100">
                            <div class="col-8 align-self-start wow fadeInUp" data-wow-delay="0.1s">
                                <img class="img-fluid" src="{{ asset('public/img/dynapack.png') }}">
                            </div>
                            <div class="col-8 align-self-end wow fadeInDown" data-wow-delay="0.1s">
                                <img class="img-fluid" src="{{ asset('public/img/RapidPlast.png') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <p class="fw-medium text-uppercase text-primary mb-2">About Us</p>
                        <h1 class="display-5 mb-4">Rapid Plast Indonesia</h1>
                        <p class="mb-4">PT Rapid Plast is a subsidiary of Dynapack Asia. It focuses on serving customers in the eastern region of Indonesia. 
                            The company manufactures various types of plastic packaging and toothbrushes and is the sole facility across Dynapack Asia to operate a manufacturing plant for plastic tubes in Cikarang. 
                            Leveraging geography, size, and a complete manufacturing process (EBM, ISBM, IBM, IM, and Tube), Rapid Plast has become a strong player in the industry.
                        </p>
                        <div class="d-flex align-items-center mb-4">
                            <div class="flex-shrink-0 bg-primary p-4">
                                <h5 class="text-white">Over</h5>
                                <h1 class="display-2">30</h1>
                                <h5 class="text-white">Years of</h5>
                                <h5 class="text-white">Experience</h5>
                            </div>
                            <div class="ms-4">
                                <p><i class="fa fa-check text-primary me-2"></i>Costumer centrik</p>
                                <p><i class="fa fa-check text-primary me-2"></i>Opertional excellence</p>
                                <p><i class="fa fa-check text-primary me-2"></i>Innovation</p>
                                <p><i class="fa fa-check text-primary me-2"></i>performance driven</p>
                                <p class="mb-0"><i class="fa fa-check text-primary me-2"></i>Team work</p>
                            </div>
                        </div>
                        <div class="row pt-2">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                        <i class="fa fa-envelope-open text-white"></i>
                                    </div>
                                    <div class="ms-3">
                                        <p class="mb-2">Email us</p>
                                        <h5 class="mb-0">hrd@rapidplast.id</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                        <i class="fa fa-phone-alt text-white"></i>
                                    </div>
                                    <div class="ms-3" >
                                        <p class="mb-2">Call us</p>
                                        <h5 class="mb-0">(031)8436669</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-dark footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Our Office</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i> Plant 1: Jl. Berbek Industri V No.10, Bebek, Berbek, Kec. Waru, Kabupaten Sidoarjo, Jawa Timur 61256 </p>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Plant 2 & 4: Jl. Raya Surabaya - Malang No.54, Palang, Lemahbang, Sukorejo, Pasuruan Regency, Jawa Timur, 67161 </p>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Plant 3: Jl. Jababeka IX Blok E 9 - 17 Bekasi, Jawa Barat, 17520 </p>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Plant 5: Jl. Kranji No.2b, Cicau, Central Cikarang, Bekasi Regency, Jawa Barat, 17530 </p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>(031)8436669</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>hrd@rapidplast.id</p>
                        <div class="d-flex pt-3">
                            <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i
                                    class="fab fa-youtube"></i></a>
                            <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i
                                    class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Quick Links</h5>
                        <a class="btn btn-link" href="">Meeting Reservation</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Business Hours</h5>
                        <p class="mb-1">Monday - Friday</p>
                        <h6 class="text-light">08:00 am - 05:00 pm</h6>
                        <p class="mb-1">Saturday</p>
                        <h6 class="text-light">08:00 am - 05:00 pm</h6>
                        <p class="mb-1">Sunday</p>
                        <h6 class="text-light">Closed</h6>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Newsletter</h5>
                        <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                        <div class="position-relative w-100">
                            <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text"
                                placeholder="Your email">
                            <button type="button"
                                class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid copyright bg-dark py-4">
            <div class="container text-center">
                <p class="mb-2">Copyright &copy; <a class="fw-semi-bold" href="#">Meeting Room Rapid Plast</a>, All Right Reserved.
                </p>
                <p class="mb-0">Designed By <a class="fw-semi-bold" href="https://htmlcodex.com">HTML Codex</a> Distributed
                    By: <a href="https://themewagon.com">ThemeWagon</a> </p>
            </div>
        </div>
        <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
                class="bi bi-arrow-up"></i></a>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="public/lib/wow/wow.min.js"></script>
        <script src="public/lib/easing/easing.min.js"></script>
        <script src="public/lib/waypoints/waypoints.min.js"></script>
        <script src="public/lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="public/lib/counterup/counterup.min.js"></script>
        <script src="public/js/main.js"></script>
        <script>
    function copyPhoneNumber() {
        var phoneNumberElement = document.getElementById('phoneNumber');
        var tempInput = document.createElement('input');
        tempInput.value = phoneNumberElement.innerText;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        alert('Nomor telepon telah disalin: ' + tempInput.value);
    }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>