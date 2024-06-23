<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengaduan;
use App\Models\Tanggapan;

class PengaduanController extends Controller
{
    public function index($status)
    {
        // Ambil informasi petugas yang sedang masuk
        $user = Auth::guard('admin')->user();

        // Cek peran pengguna
        if ($user->roles === 'admin') {
            // Admin dapat melihat semua pengaduan
            $pengaduan = Pengaduan::where('status', $status)
                            ->orderBy('tgl_pengaduan', 'desc')
                            ->get();
        } elseif ($user->roles === 'ketuarw' || $user->roles === 'petugas') {
            // Ketua RW atau Petugas hanya dapat melihat pengaduan dari perumahan yang sama
            $pengaduan = Pengaduan::where('status', $status)
                            ->where('perumahan_id', $user->perumahan_id)
                            ->orderBy('tgl_pengaduan', 'desc')
                            ->get();
        } else {
            // Akses tidak diizinkan untuk peran lain
            abort(403, 'Unauthorized action.');
        }

        return view('pages.admin.pengaduan.index', compact('pengaduan', 'status'));
    }


    public function show($id_pengaduan)
    {
        $pengaduan = Pengaduan::find($id_pengaduan);

        if (!$pengaduan) {
            abort(404);
        }

        $tanggapan = Tanggapan::where('id_pengaduan', $id_pengaduan)->first();

        return view('pages.admin.pengaduan.show', compact('pengaduan', 'tanggapan'));
    }

    public function destroy(Request $request, $id_pengaduan)
    {
        $pengaduan = Pengaduan::find($id_pengaduan);

        if (!$pengaduan) {
            abort(404);
        }

        $pengaduan->delete();

        if ($request->ajax()) {
            return 'success';
        }

        return redirect()->route('pengaduan.index');
    }

    public function verifikasi(Request $request)
    {
        $id_pengaduan = $request->id_pengaduan;

        $pengaduan = Pengaduan::find($id_pengaduan);

        if (!$pengaduan) {
            return response()->json('error', 404);
        }

        // Lakukan proses verifikasi pengaduan disini
        $pengaduan->status = 'proses';
        $pengaduan->save();

        return response()->json('success');
    }
}
