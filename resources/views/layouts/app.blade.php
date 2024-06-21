<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title') |Lapormas Masyarakat</title>
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

    <!-- Custom CSS -->
    <style>
        body {
            padding-top: 20px;
            /* Menambahkan padding top untuk menyisipkan navbar */
        }

        .content {
            padding-bottom: 20px;
            /* Menambahkan padding bottom untuk memberikan jarak dengan footer */
        }
    </style>

    @stack('styles')
</head>

<body>
    <header id="header" class="fixed-top" style="background-color: #fefefe;">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="/"><span style="color: grey;">LAPOR</span> <span
                        style="color: #b21e1e;">MAS</span></a></h1>

            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto {{ request()->is('/pengaduan') ? 'active' : '' }}"
                            href="{{ route('pengaduan') }}">Buat Pengaduan</a></li>
                    <li><a class="nav-link scrollto {{ request()->is('pengaduan.laporan') ? 'active' : '' }}"
                            href="{{ route('pengaduan.laporan', 'saya') }}">Pengaduan Saya</a></li>
                    @auth('masyarakat')
                        <li><a class="nav-link scrollto {{ request()->is('profile') ? 'active' : '' }}"
                                href="{{ route('user.profile') }}">Profile</a></li>
                        <li><a href="{{ route('user.logout') }}"
                                style="background-color: #b21e1e; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Logout</a>
                        </li>
                    @else
                        <li><a href="{{ url('login') }}" class="appointment-btn scrollto">Login</a></li>
                    @endauth
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <main id="main">
        <div class="content">
            @yield('content')
        </div>
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container d-md-flex justify-content-md-between py-4">
            <div class="text-center text-md-start mb-4 mb-md-0">
                &copy; 2024 Lapormas. All rights reserved.
            </div>
            <div class="social-links text-center text-md-end">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </footer><!-- End Footer -->


    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>
