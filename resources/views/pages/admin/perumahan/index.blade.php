@extends('layouts.admin')

@section('title', 'Perumahan')

@push('addon-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <!-- Header -->
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
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0 d-flex justify-content-between">
                        <h3 class="mb-0">Data Perumahan</h3>
                        <a href="{{ route('perumahan.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah
                            Perumahan</a>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="perumahanTable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="no">No</th>
                                    <th scope="col" class="sort" data-sort="nama_perumahan">Nama Perumahan</th>
                                    <th scope="col" class="sort" data-sort="alamat">Alamat</th>
                                    <th scope="col" class="sort" data-sort="contact">Contact</th>
                                    <th scope="col" class="sort" data-sort="action">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($perumahans as $k => $perumahan)
                                    <tr>
                                        <td>{{ $k + 1 }}</td>
                                        <td>{{ $perumahan->nama_perumahan }}</td>
                                        <td>{{ $perumahan->alamat }}</td>
                                        <td>{{ $perumahan->contact }}</td>
                                        <td style="width: 100px;">
                                            <a href="{{ route('perumahan.edit', $perumahan->id) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <a href="#" data-id="{{ $perumahan->id }}"
                                                class="btn btn-sm btn-danger perumahanDelete">Hapus</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer py-4">
                        <nav aria-label="...">
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">
                                        <i class="fas fa-angle-left"></i>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 -->

    <script>
        $(document).ready(function() {
            $('#perumahanTable').DataTable();

            $(document).on('click', '.perumahanDelete', function(e) {
                e.preventDefault();
                let id = $(this).data('id');

                Swal.fire({
                    title: 'Peringatan!',
                    text: "Apakah Anda yakin akan menghapus perumahan?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28B7B5',
                    cancelButtonColor: '#DC3545',
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: '{{ route('perumahan.delete', 'id') }}'.replace('id', id),
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": id,
                            },
                            success: function(response) {
                                if (response.success) {
                                    // Menghapus baris dari tabel setelah penghapusan berhasil
                                    $('#perumahanTable').DataTable().row($(
                                        '#perumahanTable').find('a[data-id="' +
                                        id + '"]').parents('tr')).remove().draw();

                                    // Tampilkan SweetAlert bahwa perumahan berhasil dihapus
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: "Perumahan berhasil dihapus!",
                                        icon: 'success',
                                        confirmButtonColor: '#28B7B5',
                                        confirmButtonText: 'OK'
                                    });
                                } else {
                                    // Menampilkan alert bahwa gagal menghapus hanya jika respons tidak berhasil
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: "Gagal menghapus perumahan.",
                                        icon: 'error',
                                        confirmButtonColor: '#28B7B5',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            },
                            error: function(data) {
                                // Menampilkan alert bahwa terjadi kesalahan saat menghapus
                                Swal.fire({
                                    title: 'Error!',
                                    text: "Terjadi kesalahan saat menghapus perumahan.",
                                    icon: 'error',
                                    confirmButtonColor: '#28B7B5',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
