@extends('layouts.app')
@section('title', 'Perumahan')


@push('addon-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
@endpush
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register Perumahan') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('perumahan.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="nama_perumahan"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nama Perumahan') }}</label>

                                <div class="col-md-6">
                                    <input id="nama_perumahan" type="text"
                                        class="form-control @error('nama_perumahan') is-invalid @enderror"
                                        name="nama_perumahan" value="{{ old('nama_perumahan') }}" required
                                        autocomplete="nama_perumahan" autofocus>

                                    @error('nama_perumahan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="province_id"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Province') }}</label>

                                <div class="col-md-6">
                                    <select name="province_id" id="province_id"
                                        class="form-control @error('province_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Provinsi --</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('province_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="regency_id"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Kota/Kabupaten') }}</label>

                                <div class="col-md-6">
                                    <select name="regency_id" id="regency_id"
                                        class="form-control @error('regency_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Kota/Kabupaten --</option>
                                    </select>

                                    @error('regency_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="district_id"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Kecamatan') }}</label>

                                <div class="col-md-6">
                                    <select name="district_id" id="district_id"
                                        class="form-control @error('district_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Kecamatan --</option>
                                    </select>

                                    @error('district_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="village_id"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Desa/Kelurahan') }}</label>

                                <div class="col-md-6">
                                    <select name="village_id" id="village_id"
                                        class="form-control @error('village_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Desa/Kelurahan --</option>
                                    </select>

                                    @error('village_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alamat"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Alamat Perumahan') }}</label>

                                <div class="col-md-6">
                                    <textarea id="alamat" class="form-control @error('alamat') is-invalid @enderror" name="alamat" required>{{ old('alamat') }}</textarea>

                                    @error('alamat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#province_id').on('change', function() {
                var province_id = $(this).val();
                if (province_id) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('get-regencies') }}",
                        data: {
                            province_id: province_id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            $('#regency_id').html(data);
                            $('#district_id').html(
                                '<option value="">-- Pilih Kecamatan --</option>');
                            $('#village_id').html(
                                '<option value="">-- Pilih Desa/Kelurahan --</option>');
                        }
                    });
                } else {
                    $('#regency_id').html('<option value="">-- Pilih Kota/Kabupaten --</option>');
                    $('#district_id').html('<option value="">-- Pilih Kecamatan --</option>');
                    $('#village_id').html('<option value="">-- Pilih Desa/Kelurahan --</option>');
                }
            });

            $('#regency_id').on('change', function() {
                var regency_id = $(this).val();
                if (regency_id) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('get-districts') }}",
                        data: {
                            regency_id: regency_id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            $('#district_id').html(data);
                            $('#village_id').html(
                                '<option value="">-- Pilih Desa/Kelurahan --</option>');
                        }
                    });
                } else {
                    $('#district_id').html('<option value="">-- Pilih Kecamatan --</option>');
                    $('#village_id').html('<option value="">-- Pilih Desa/Kelurahan --</option>');
                }
            });

            $('#district_id').on('change', function() {
                var district_id = $(this).val();
                if (district_id) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('get-villages') }}",
                        data: {
                            district_id: district_id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            $('#village_id').html(data);
                        }
                    });
                } else {
                    $('#village_id').html('<option value="">-- Pilih Desa/Kelurahan --</option>');
                }
            });
        });
    </script>
@endsection
