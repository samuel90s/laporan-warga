<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\VerifikasiEmailUntukRegistrasiPengaduanMasyarakat;
use App\Models\Masyarakat;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\Petugas;
use App\Models\Province;
use App\Models\Perumahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Carbon;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Str;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::count();
        $proses = Pengaduan::where('status', 'proses')->count();
        $selesai = Pengaduan::where('status', 'selesai')->count();

        return view('home', [
            'pengaduan' => $pengaduan,
            'proses' => $proses,
            'selesai' => $selesai,
        ]);
    }

    public function masuk()
    {
        return view('pages.user.login');
    }

    public function login(Request $request)
    {

        $data = $request->all();

        $validate = Validator::make($data, [
            'username' => ['required'],
            'password' => ['required']
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {

            $email = Masyarakat::where('email', $request->username)->first();

            if (!$email) {
                return redirect()->back()->with(['pesan' => 'Email tidak terdaftar']);
            }

            $password = Hash::check($request->password, $email->password);


            if (!$password) {
                return redirect()->back()->with(['pesan' => 'Password tidak sesuai']);
            }

            if (Auth::guard('masyarakat')->attempt(['email' => $request->username, 'password' => $request->password])) {

                return redirect()->route('pengaduan');
            } else {

                return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
            }
        } else {

            $masyarakat = Masyarakat::where('username', $request->username)->first();

            $petugas = Petugas::where('username', $request->username)->first();

            if ($masyarakat) {
                $username = Masyarakat::where('username', $request->username)->first();

                if (!$username) {
                    return redirect()->back()->with(['pesan' => 'Username tidak terdaftar']);
                }

                $password = Hash::check($request->password, $username->password);

                if (!$password) {
                    return redirect()->back()->with(['pesan' => 'Password tidak sesuai']);
                }

                if (Auth::guard('masyarakat')->attempt(['username' => $request->username, 'password' => $request->password])) {

                    return redirect()->route('pengaduan');
                } else {

                    return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
                }
            } elseif ($petugas) {
                $username = Petugas::where('username', $request->username)->first();

                if (!$username) {
                    return redirect()->back()->with(['pesan' => 'Username tidak terdaftar']);
                }

                $password = Hash::check($request->password, $username->password);

                if (!$password) {
                    return redirect()->back()->with(['pesan' => 'Password tidak sesuai']);
                }

                if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {

                    return redirect()->route('dashboard');
                } else {

                    return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
                }
            } else {
                return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
            }
        }
    }

    public function register()
    {
        $provinces = Province::all();
        $perumahans = Perumahan::all();
        return view('pages.user.register', compact('provinces','perumahans'));
    }

    public function register_post(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'nik' => ['required', 'min:16', 'max:16', 'unique:masyarakat'],
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'string', 'unique:masyarakat'],
            'username' => ['required', 'string', 'regex:/^\S*$/u', 'unique:masyarakat', 'unique:petugas,username'],
            'jenis_kelamin' => ['required'],
            'password' => ['required', 'min:6'],
            'telp' => ['required', 'regex:/(08)[0-9]/'],
            'alamat' => ['required'],
            'rt' => ['required'],
            'rw' => ['required'],
            'kode_pos' => ['required'],
            'province_id' => ['required'],
            'regency_id' => ['required'],
            'district_id' => ['required'],
            'village_id' => ['required'],
            'perumahan_id' => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        Masyarakat::create([
            'nik' => $data['nik'],
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => strtolower($data['username']),
            'jenis_kelamin' => $data['jenis_kelamin'],
            'password' => Hash::make($data['password']),
            'telp' => $data['telp'],
            'alamat' => $data['alamat'],
            'email_verified_at' => Carbon::now(),
            'rt' => $data['rt'],
            'rw' => $data['rw'],
            'kode_pos' => $data['kode_pos'],
            'province_id' => $data['province_id'],
            'regency_id' => $data['regency_id'],
            'district_id' => $data['district_id'],
            'village_id' => $data['village_id'],
            'perumahan_id' => $data['perumahan_id'],
        ]);

        $masyarakat = Masyarakat::where('email', $data['email'])->first();

        Auth::guard('masyarakat')->login($masyarakat);

        return redirect('/pengaduan');
    }

    public function logout()
    {
        Auth::guard('masyarakat')->logout();

        return redirect('/login');
    }
// ====================================start pengaduan
    public function pengaduan()
    {
        $pengaduan = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)->get();
        return view('pages.user.pengaduan', compact('pengaduan'));
    }

    public function storePengaduan(Request $request)
    {
        // Validasi apakah masyarakat sudah login dan akunnya sudah diverifikasi
        if (!Auth::guard('masyarakat')->check()) {
            return redirect()->back()->with(['pengaduan' => 'Login dibutuhkan!', 'type' => 'error']);
        } elseif (Auth::guard('masyarakat')->user()->email_verified_at == null && Auth::guard('masyarakat')->user()->telp_verified_at == null) {
            return redirect()->back()->with(['pengaduan' => 'Akun belum diverifikasi!', 'type' => 'error']);
        }

        // Validasi data input
        $validate = Validator::make($request->all(), [
            'judul_laporan' => ['required'],
            'isi_laporan' => ['required'],
            'tgl_kejadian' => ['required'],
            'lokasi_kejadian' => ['required'],
            'category_pengaduan' => ['required'],
            'foto' => ['nullable', 'image', 'max:2048'] // Optional: tambahkan validasi untuk file foto
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Simpan foto jika ada
        $fotoPath = 'assets/pengaduan/default.jpg'; // Gambar default jika tidak ada foto yang diunggah
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('assets/pengaduan', 'public');
        }

        // Simpan pengaduan baru
        $pengaduan = Pengaduan::create([
            'tgl_pengaduan' => now(),
            'nik' => Auth::guard('masyarakat')->user()->nik,
            'judul_laporan' => $request->judul_laporan,
            'isi_laporan' => $request->isi_laporan,
            'tgl_kejadian' => $request->tgl_kejadian,
            'lokasi_kejadian' => $request->lokasi_kejadian,
            'foto' => $fotoPath,
            'status' => '0',
            'category_pengaduan' => $request->category_pengaduan,
            'perumahan_id' => Auth::guard('masyarakat')->user()->perumahan_id,
        ]);

        if (!$pengaduan) {
            return redirect()->back()->with(['pengaduan' => 'Gagal mengirim pengaduan!', 'type' => 'error']);
        }

        return redirect()->back()->with(['pengaduan' => 'Berhasil mengirim pengaduan!', 'type' => 'success']);
    }

    public function detailPengaduan($id_pengaduan)
{
    // Ambil pengaduan berdasarkan id_pengaduan dan nik pengguna yang sedang login
    $pengaduan = Pengaduan::where('id_pengaduan', $id_pengaduan)
        ->where('nik', Auth::guard('masyarakat')->user()->nik)
        ->first();

    // Jika pengaduan tidak ditemukan, kembalikan response redirect
    if (!$pengaduan) {
        return redirect()->back()->with(['pengaduan' => 'Pengaduan tidak ditemukan atau Anda tidak memiliki akses!', 'type' => 'error']);
    }

    // Tampilkan halaman detail pengaduan dengan data pengaduan yang ditemukan
    return view('pages.user.detail', ['pengaduan' => $pengaduan]);
}
// =======================================end pengaduan

// ==================================tanggapan
public function tanggapan(Request $request)
    {
        // Validasi apakah petugas sudah login
        if (!Auth::guard('petugas')->check()) {
            return redirect()->back()->with(['pengaduan' => 'Anda tidak memiliki akses!', 'type' => 'error']);
        }

        // Validasi data input
        $validate = Validator::make($request->all(), [
            'id_pengaduan' => ['required', 'exists:pengaduan,id_pengaduan'],
            'tanggapan' => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Simpan tanggapan
        $tanggapan = Tanggapan::create([
            'id_pengaduan' => $request->id_pengaduan,
            'tgl_tanggapan' => now(),
            'tanggapan' => $request->tanggapan,
            'id_petugas' => Auth::guard('petugas')->user()->id_petugas,
        ]);

        if (!$tanggapan) {
            return redirect()->back()->with(['pengaduan' => 'Gagal menyimpan tanggapan!', 'type' => 'error']);
        }

        // Ubah status pengaduan menjadi '1' (sedang ditanggapi)
        $pengaduan = Pengaduan::find($request->id_pengaduan);
        $pengaduan->status = '1';
        $pengaduan->save();

        return redirect()->back()->with(['pengaduan' => 'Berhasil menyimpan tanggapan!', 'type' => 'success']);
    }
// ===================================end tanggapan
    public function laporanEdit($id_pengaduan)
    {
        $pengaduan = Pengaduan::where('id_pengaduan', $id_pengaduan)->first();

        return view('user.edit', ['pengaduan' => $pengaduan]);
    }

    public function laporanUpdate(Request $request, $id_pengaduan)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'judul_laporan' => ['required'],
            'isi_laporan' => ['required'],
            'tgl_kejadian' => ['required'],
            'lokasi_kejadian' => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        if ($request->file('foto')) {
            $data['foto'] = $request->file('foto')->store('assets/pengaduan', 'public');
        }

        $pengaduan = Pengaduan::where('id_pengaduan', $id_pengaduan)->first();

        $pengaduan->update([
            'judul_laporan' => $data['judul_laporan'],
            'isi_laporan' => $data['isi_laporan'],
            'tgl_kejadian' => $data['tgl_kejadian'],
            'lokasi_kejadian' => $data['lokasi_kejadian'],
            'foto' => $data['foto'] ?? $pengaduan->foto
        ]);

        return redirect()->route('pekat.detail', $id_pengaduan);
    }
// ------------------------------------------laporan

    public function laporan($who = '')
    {
        $terverifikasi = Pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', '!=', '0']])->get()->count();
        $proses = Pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', 'proses']])->get()->count();
        $selesai = Pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', 'selesai']])->get()->count();

        $hitung = [$terverifikasi, $proses, $selesai];

        if ($who == 'saya') {

            $pengaduan = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)->orderBy('tgl_pengaduan', 'desc')->get();

            return view('pages.user.laporan', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'who' => $who]);
        } else {

            $pengaduan = Pengaduan::where('status', '!=', '0')->orderBy('tgl_pengaduan', 'desc')->get();

            return view('pages.user.laporan', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'who' => $who]);
        }
    }
    public function laporanDestroy(Request $request)
    {
        $pengaduan = Pengaduan::where('id_pengaduan', $request->id_pengaduan)->first();

        $pengaduan->delete();

        return 'success';
    }
// -------------------------------------end laparan

    public function showForgotPasswordForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $masyarakat = Masyarakat::where('email', $request->email)->first();

        if (!$masyarakat) {
            return back()->withErrors(['email' => 'Email tidak terdaftar']);
        }

        $token = Str::random(60); // Generate a random token
        $masyarakat->notify(new ResetPasswordNotification($token)); // Menggunakan $token dalam notifikasi

        return back()->with('status', 'Link reset password telah dikirim!');
    }

    public function profile()
    {
        $nik = Auth::guard('masyarakat')->user()->nik;
        $masyarakat = Masyarakat::where('nik', $nik)->first();
        $perumahans = Perumahan::all();

        return view('pages.user.profile', compact('masyarakat', 'perumahans'));
    }

    public function updateProfile(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'username' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'telp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'rt' => 'required|string|max:10',
            'rw' => 'required|string|max:10',
        ]);

        // Dapatkan instance Masyarakat yang sedang login
        $masyarakat = auth()->guard('masyarakat')->user();

        // Update atribut-atribut pada model Masyarakat
        $masyarakat->name = $request->name;
        $masyarakat->email = $request->email;
        $masyarakat->username = $request->username;
        $masyarakat->jenis_kelamin = $request->jenis_kelamin;
        $masyarakat->telp = $request->telp;
        $masyarakat->alamat = $request->alamat;
        $masyarakat->rt = $request->rt;
        $masyarakat->rw = $request->rw;

        // Simpan perubahan pada model Masyarakat
        $masyarakat->save();

        // Redirect dengan pesan sukses
        return redirect()->route('user.profile')->with([
            'pesan' => 'Profil berhasil diperbarui.',
            'type' => 'success',
        ]);
    }


}
