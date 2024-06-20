@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
    <main id="main" class="martop">

        <section class="inner-page">
            <div class="container">
                <div class="title text-center mb-5">
                    <h1 class="fw-bold">Pengaduan Saya</h1>
                    <p class="lead">Lihat daftar pengaduan yang telah Anda buat</p>
                </div>

                <div class="pengaduan">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @forelse($pengaduan as $item)
                            <div class="col">
                                <div class="card h-100 shadow">
                                    <img src="{{ Storage::url($item->foto) }}" class="card-img-top" alt="Foto Pengaduan">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>{{ $item->judul_laporan }}</b></h5>
                                        <p class="card-text">{{ Str::limit($item->isi_laporan, 100) }}</p>
                                        <a href="{{ route('pengaduan.detail', $item->id_pengaduan) }}"
                                            class="btn btn-primary">Lihat Detail</a>
                                    </div>
                                    <div class="card-footer">
                                        <b>Category Pengaduan:</b> {{ $item->category_pengaduan }}<br>
                                        <small class="text-muted">Tanggal Kejadian:
                                            {{ Carbon\Carbon::parse($item->tgl_kejadian)->isoFormat('LL') }}</small>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col">
                                <div class="card h-100 shadow">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Belum Ada Pengaduan</h5>
                                        <p class="card-text">Anda belum membuat pengaduan apapun.</p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </section>
    </main><!-- End #main -->
@endsection
