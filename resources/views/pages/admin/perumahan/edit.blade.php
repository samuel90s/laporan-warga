@extends('layouts.admin')

@section('title', 'Edit Perumahan')

@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Perumahan</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0 d-flex justify-content-between">
                        <h3 class="mb-0">Edit Perumahan</h3>
                        <a href="{{ route('perumahan.index') }}" class="btn btn-secondary"><i
                                class="fas fa-arrow-circle-left"></i> Kembali</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('perumahan.update', $perumahan->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama_perumahan">Nama Perumahan</label>
                                <input type="text" class="form-control" id="nama_perumahan" name="nama_perumahan"
                                    value="{{ $perumahan->nama_perumahan }}" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ $perumahan->alamat }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input type="text" class="form-control" id="contact" name="contact"
                                    value="{{ $perumahan->contact }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('addon-script')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#perumahanTable').DataTable();
        });
    </script>
@endpush
