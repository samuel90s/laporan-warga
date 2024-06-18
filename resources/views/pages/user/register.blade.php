<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Register | Lapormas</title>

    @stack('prepend-style')
    @include('includes.admin.style')
    @stack('addon-style')
</head>

<body class="bg-light">
    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header py-7 py-lg-8 pt-lg-9" style="background-color: #b21e1e;">
            <div class="container">
                <div class="header-body text-center mb-3">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                            <h1 class="text-white">Register</h1>
                            <p class="text-lead text-white">Silahkan isi form untuk membuat akun baru.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <!-- Table -->
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="card bg-secondary border-0">
                        <div class="card-header bg-transparent pb-5">
                            <form action="{{ route('user.register-post') }}" role="form" method="POST">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"></span>
                                        </div>
                                        <input type="number" value="{{ old('nik') }}"
                                            class="form-control @error('nik') is-invalid @enderror" name="nik"
                                            id="nik" placeholder="NIK">
                                        @error('nik')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"></span>
                                        </div>
                                        <input type="text" value="{{ old('name') }}"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            id="name" placeholder="Nama">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"></span>
                                        </div>
                                        <input type="text" value="{{ old('username') }}"
                                            class="form-control @error('username') is-invalid @enderror" name="username"
                                            id="username" placeholder="Username">
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"></span>
                                        </div>
                                        <input type="email" value="{{ old('email') }}"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            id="email" placeholder="Email">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"></span>
                                        </div>
                                        <input type="number " value="{{ old('telp') }}"
                                            class="form-control @error('telp') is-invalid @enderror" name="telp"
                                            id="telp" placeholder="No Telpon">
                                        @error('telp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"></span>
                                        </div>
                                        <textarea type="text" value="{{ old('alamat') }}" class="form-control @error('alamat') is-invalid @enderror"
                                            name="alamat" id="alamat" placeholder="Alamat"></textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"></span>
                                        </div>
                                        <select name="jenis_kelamin"
                                            class="custom-select @error('jenis_kelamin') is-invalid @enderror">
                                            <option value="">Silahkan Pilih Jenis Kelamin Anda</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"></span>
                                        </div>
                                        <input type="number" value="{{ old('rt') }}"
                                            class="form-control @error('rt') is-invalid @enderror" name="rt"
                                            id="rt" placeholder="rt001">
                                        @error('rt')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"></span>
                                        </div>
                                        <input type="number" value="{{ old('rw') }}"
                                            class="form-control @error('rw') is-invalid @enderror" name="rw"
                                            id="rw" placeholder="rw002">
                                        @error('rw')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"></span>
                                        </div>
                                        <input type="number" value="{{ old('kode_pos') }}"
                                            class="form-control @error('kode_pos') is-invalid @enderror"
                                            name="kode_pos" max="99999" id="kode_pos" placeholder="kd pos16515">
                                        @error('kode_pos')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"></span>
                                        </div>
                                        <select name="province_id"
                                            class="custom-select @error('province_id') is-invalid @enderror"
                                            id="province_id">
                                            <option value="">-- Pilih Provinsi --</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('province_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"></span>
                                        </div>
                                        <select name="regency_id"
                                            class="custom-select @error('regency_id') is-invalid @enderror"
                                            id="regency_id">
                                            <option value="">-- Pilih Kota/Kabupaten --</option>
                                        </select>
                                        @error('regency_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"></span>
                                        </div>
                                        <select name="district_id"
                                            class="custom-select @error('district_id') is-invalid @enderror"
                                            id="district_id">
                                            <option value="">-- Pilih Kecamatan --</option>
                                        </select>
                                        @error('district_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"></span>
                                        </div>
                                        <select name="village_id"
                                            class="custom-select @error('village_id') is-invalid @enderror"
                                            id="village_id">
                                            <option value="">-- Pilih Desa/Kelurahan --</option>
                                        </select>
                                        @error('village_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"></span>
                                        </div>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            name="password" id="password" placeholder="Password">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- <div class="text-muted font-italic"><small>password strength: <span class="text-success font-weight-700">strong</span></small></div> -->
                                <!-- <div class="row my-4">
                                <div class="col-12">
                                  <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input class="custom-control-input" id="customCheckRegister" type="checkbox">
                                    <label class="custom-control-label" for="customCheckRegister">
                                      <span class="text-muted">I agree with the <a href="#!">Privacy Policy</a></span>
                                    </label>
                                  </div>
                                </div>
                              </div> -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-4">Buat Akun</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 text-right">
                            <a href="{{ url('login') }}" class="text-primary"><small>Sudah punya akun?</small></a>
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
                            target="_blank">Lapormas</a></span></strong>. {{ date('Y') }}. All rights reserved.
            </div>
        </div>
    </footer>
    <!-- Argon Scripts -->
    @stack('prepend-script')
    @include('includes.admin.script')
    @stack('addon-script')

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            $(function() {
                $('#province_id').on('change', function() {
                    let province_id = $('#province_id').val();

                    console.log(province_id);

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('getkota') }}",
                        data: {
                            province_id: province_id
                        },
                        cache: false,

                        success: function(message) {
                            $('#regency_id').html(message);
                            $('#district_id').html('');
                            $('#village_id').html('');
                        },
                        error: function(data) {
                            console.log(`Error on ${data}`);
                        }
                    });
                });

                $('#regency_id').on('change', function() {
                    let regency_id = $('#regency_id').val();
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('getkecamatan') }}",
                        data: {
                            regency_id: regency_id
                        },
                        cache: false,

                        success: function(message) {
                            $('#district_id').html(message);
                            $('#village_id').html('');
                        },

                        error: function(data) {
                            console.log(`Error on ${data}`);
                        }
                    });
                });

                $('#district_id').on('change', function() {
                    let district_id = $('#district_id').val();
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('getdesa') }}",
                        data: {
                            district_id: district_id
                        },
                        cache: false,

                        success: function(message) {
                            $('#village_id').html(message);
                        },
                        error: function(data) {
                            console.log(`Error on ${data}`);
                        }

                    })
                })
            })
        });
    </script>
</body>

</html>
