<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Lapormas</title>
    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Stack style and addon style -->
    @stack('prepend-style')
    @include('includes.admin.style')
    @stack('addon-style')
</head>

<body class="bg-light">
    <!-- Navbar -->
    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header py-7 py-lg-8 pt-lg-9" style="background-color: #b21e1e;">
            <div class="container">
                <div class="header-body text-center mb-3">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-6">
                            <h1 class="text-white">Login | Lapormas</h1>
                            <p class="text-lead text-white">Silahkan login menggunakan akun yang sudah didaftarkan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary border-0 mb-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <form role="form" action="{{ route('user.login') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" value="{{ old('username') }}"
                                            class="form-control @error('username') is-invalid @enderror" name="username"
                                            id="username" placeholder="Email atau Username" required>
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input class="form-control @error('password') is-invalid @enderror"
                                            name="password" id="password" placeholder="Password" type="password"
                                            required>
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input class="custom-control-input" id="customCheckLogin" type="checkbox">
                                    <label class="custom-control-label" for="customCheckLogin">
                                        <span class="text-muted">Remember me</span>
                                    </label>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <a href="/" class="btn btn-secondary">Home</a>
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </form>
                            <div class="row mt-3">
                                <div class="col-6">
                                    <a href="{{ route('password.request') }}" class="text-primary"><small>Lupa
                                            password?</small></a>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{ url('register') }}" class="text-primary"><small>Buat akun
                                            baru</small></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="py-5" id="footer-main" style="background-color: #2b1e1e;">
        <div class="container">
            <div class="row">
            </div>
            <hr class="my-4" style="border-top-color: #ffffff;">
            <div class="text-center text-white">
                &copy; <strong><span><a href="#" class="text-white" target="_blank">Lapormas</a></span></strong>.
                {{ date('Y') }}. All rights reserved.
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
        integrity="sha384-KyZXEAg3QhqLMpG8r+u0KkoG8jswxSG++XL2qCkU6GhR3S3bU/1MXv2wvJ0hWLbX" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+8q+8b5lQXdFwxlOO5quC5qUpnEJqO6w3I6" crossorigin="anonymous">
    </script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom Script -->
    <script>
        // Optional: Add your custom scripts here
    </script>

    <!-- Stack prepend and addon script -->
    @stack('prepend-script')
    @include('includes.admin.script')
    @stack('addon-script')

    <!-- SweetAlert notification -->
    @if (session()->has('pesan'))
        <script>
            Swal.fire(
                'Pemberitahuan!',
                '{{ session()->get('pesan') }}',
                'error'
            );
        </script>
    @endif

</body>

</html>
