<!-- resources/views/pengaduan/detail.blade.php -->

@extends('layouts.app')

@section('title', 'Detail Pengaduan')

@section('content')
    <main id="main" class="martop">
        <section class="inner-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-responsive p-4 border-0 shadow rounded mx-auto">
                            <h5><b>Data Pelapor</b></h5>
                            <p>
                                {{ optional($pengaduan->user)->name ?? 'Nama Tidak Tersedia' }} <br>
                                {{ optional($pengaduan->tgl_kejadian)->format('d F Y') }} <br>
                                <b>Category Pengaduan:</b> {{ $pengaduan->category_pengaduan }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card card-responsive p-4 border-0 shadow rounded mx-auto text-center">
                            @if ($pengaduan->foto)
                                <img src="{{ Storage::url($pengaduan->foto) }}" alt="Foto Pengaduan"
                                    style="max-width: 100%; height: auto;">
                            @else
                                <p class="text-muted">Foto tidak tersedia</p>
                            @endif
                            <h3>{{ $pengaduan->judul_laporan }}</h3>
                            <p>
                                @php
                                    $statusColor = [
                                        '0' => 'danger',
                                        'proses' => 'warning',
                                        'selesai' => 'success',
                                    ];
                                @endphp
                                <span class="text-sm text-white p-1 bg-{{ $statusColor[$pengaduan->status] ?? 'danger' }}">
                                    {{ ucfirst($pengaduan->status) }}
                                </span>
                            </p>
                            <p>{{ $pengaduan->isi_laporan }}</p>
                            <span class="text-sm badge badge-warning">Proses</span>
                        </div>
                    </div>
                </div>

                @if ($pengaduan->tanggapan)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tanggapan Petugas</h5>
                            <p>
                                <b>Petugas:</b>
                                {{ $pengaduan->tanggapan->petugas->nama_petugas ?? 'Petugas Tidak Tersedia' }} <br>
                                <b>Tanggal Tanggapan:</b>
                                {{ $pengaduan->tanggapan->tgl_tanggapan ? \Carbon\Carbon::parse($pengaduan->tanggapan->tgl_tanggapan)->format('d F Y') : 'Tanggal Tidak Tersedia' }}
                                <br>
                                <b>Isi Tanggapan:</b> {{ $pengaduan->tanggapan->tanggapan }} <br>
                            </p>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning" role="alert">
                        Belum ada tanggapan dari petugas untuk pengaduan ini.
                    </div>
                @endif

            </div>
        </section>
    </main>
@endsection
