<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title') | Pengaduan Masyarakat</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

</head>

<body>
    <header id="header" class="fixed-top" style="background-color: #fefefe;">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="/"><span style="color: grey;">LAPOR</span> <span
                        style="color: #b21e1e;">MAS</span></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar order-last order-lg-0 ">
                <ul>
                    <li><a class="nav-link scrollto {{ request()->is('/pengaduan') ? 'active' : '' }}"
                            href="{{ route('pengaduan') }}">Buat Pengaduan</a></li>
                    {{-- <li><a class="nav-link scrollto {{ (request()->is('tentang')) ? 'active' : '' }}" href="{{ url('tentang')}}">Tentang</a></li> --}}
                    <li><a class="nav-link scrollto {{ request()->is('pengaduan.laporan') ? 'active' : '' }}"
                            href="{{ route('pengaduan.laporan', 'saya') }}">Pengaduan Saya</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

            @auth('masyarakat')
                <a href="{{ route('user.logout') }}" class="appointment-btn scrollto">Logout</a>
            @else
                <a href="{{ url('login') }}" class="appointment-btn scrollto">Login</a>
            @endauth

        </div>
    </header><!-- End Header -->

    @yield('content')

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>Lapormas</h3>
                        <p>
                            Laporkan masalah Anda di sini <br>
                            Indonesia
                        </p>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Kontak</h4>
                        <ul>
                            <p>
                                <strong>Phone:</strong> +62 812 3456 7890<br>
                                <strong>Email:</strong> lapormas@gmail.com<br>
                            </p>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <footer class="py-5" id="footer-main" style="background-color: #2b1e1e;">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h5 class="text-uppercase text-white">Company</h5>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white">About Us</a></li>
                            <li><a href="#" class="text-white">Jobs</a></li>
                            <li><a href="#" class="text-white">Press</a></li>
                            <li><a href="#" class="text-white">Blog</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h5 class="text-uppercase text-white">Support</h5>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white">Contact Us</a></li>
                            <li><a href="#" class="text-white">FAQ</a></li>
                            <li><a href="#" class="text-white">Return Policy</a></li>
                            <li><a href="#" class="text-white">Shipping Info</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h5 class="text-uppercase text-white">Services</h5>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white">Support</a></li>
                            <li><a href="#" class="text-white">Privacy Policy</a></li>
                            <li><a href="#" class="text-white">Terms of Service</a></li>
                            <li><a href="#" class="text-white">Accessibility</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h5 class="text-uppercase text-white">Follow Us</h5>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white">Facebook</a></li>
                            <li><a href="#" class="text-white">Twitter</a></li>
                            <li><a href="#" class="text-white">Instagram</a></li>
                            <li><a href="#" class="text-white">LinkedIn</a></li>
                        </ul>
                    </div>
                </div>
                <hr class="my-4" style="border-top-color: #ffffff;">
                <div class="text-center text-white">
                    &copy; <strong><span><a href="#" class="text-white"
                                target="_blank">Lapormas</a></span></strong>. {{ date('Y') }}. All rights
                    reserved.
                </div>
            </div>
        </footer>
    </footer><!-- End Footer -->


    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @stack('prepend-script')
    <!-- Vendor JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('addon-script')

</body>

</html>
