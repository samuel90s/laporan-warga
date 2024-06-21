<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengaduan;
use App\Models\Tanggapan;

class TanggapanController extends Controller
{
    public function response(Request $request)
    {
        // Temukan pengaduan berdasarkan id_pengaduan
        $pengaduan = Pengaduan::findOrFail($request->id_pengaduan);

        // Mendapatkan peran pengguna dan id perumahan yang terkait dengannya
        $user = Auth::guard('admin')->user();
        $perumahanUser = $user->perumahan_id; // Ambil ID perumahan dari petugas yang sedang login

        // Validasi akses berdasarkan peran pengguna
        if ($user->roles === 'admin') {
            // Admin dapat merespon semua pengaduan
        } elseif ($user->roles === 'ketuarw' || $user->roles === 'petugas') {
            // Ketua RW atau Petugas hanya dapat merespon pengaduan dari perumahan yang sama
            if ($pengaduan->perumahan_id !== $perumahanUser) {
                abort(403, 'Unauthorized action.');
            }
        } else {
            // Aksi tidak diizinkan jika bukan admin, ketua RW, atau petugas
            abort(403, 'Unauthorized action.');
        }

        // Cari tanggapan berdasarkan id_pengaduan
        $tanggapan = Tanggapan::where('id_pengaduan', $request->id_pengaduan)->first();

        // Data untuk diupdate atau dibuat tanggapan baru
        $data = [
            'tgl_tanggapan' => now(),
            'tanggapan' => $request->tanggapan ?? '',
            'id_petugas' => $user->id_petugas,
        ];

        // Jika sudah ada tanggapan, lakukan update
        if ($tanggapan) {
            $tanggapan->update($data);
        } else {
            // Jika belum ada tanggapan, buat tanggapan baru
            $tanggapan = Tanggapan::create(array_merge($data, [
                'id_pengaduan' => $request->id_pengaduan,
            ]));
        }

        // Update status pengaduan
        $pengaduan->update(['status' => $request->status]);

        // Response untuk AJAX
        if ($request->ajax()) {
            return 'success';
        }

        // Redirect ke halaman pengaduan dengan notifikasi
        return redirect()->route('pengaduan.show', ['id_pengaduan' => $request->id_pengaduan])
            ->with(['status' => 'Berhasil Ditanggapi!']);
    }
}
