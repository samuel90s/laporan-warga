<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Petugas;
use App\Models\Perumahan;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $petugas = Petugas::with('perumahan')->get();
        return view('pages.admin.petugas.index', compact('petugas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perumahan = Perumahan::all();
        return view('pages.admin.petugas.create', compact('perumahan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'nama_petugas' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'regex:/^\S*$/u', 'unique:petugas', 'unique:masyarakat,username'],
            'password' => ['required', 'string', 'min:6'],
            'telp' => ['required'],
            'perumahan_id' => 'nullable|exists:perumahans,id',
            'roles' => ['required', 'in:admin,petugas,ketuarw'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        };

        $username = Petugas::where('username', $data['username'])->first();

        if ($username) {
            return redirect()->back()->with(['notif' => 'Username Telah Digunakan!']);
        }

        Petugas::create([
            'nama_petugas' => $data['nama_petugas'],
            'username' => strtolower($data['username']),
            'password' => Hash::make($data['password']),
            'telp' => $data['telp'],
            'roles' => $data['roles'],
            'perumahan_id' => $data['perumahan_id'],
        ]);

        Alert::success('Berhasil', 'Petugas telah ditambahkan!');
        return redirect()->route('petugas.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id_petugas
     * @return \Illuminate\Http\Response
     */
    public function edit($id_petugas)
    {
        $petugas = Petugas::where('id_petugas', $id_petugas)->first();
        $perumahan = Perumahan::all(); // Pastikan ini ditambahkan untuk mendapatkan semua perumahan

        return view('pages.admin.petugas.edit', compact('petugas', 'perumahan'));
    }

    public function update(Request $request, $id_petugas)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'nama_petugas' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'regex:/^\S*$/u', Rule::unique('petugas')->ignore($id_petugas, 'id_petugas'), 'unique:masyarakat,username'],
            'telp' => ['required'],
            'roles' => ['required', 'in:admin,petugas,ketuarw'],
            'perumahan_id' => 'nullable|exists:perumahans,id', // Pastikan perumahan_id menggunakan tabel 'perumahans'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        $petugas = Petugas::find($id_petugas);

        if ($data['password'] != null) {
            $password = Hash::make($data['password']);
        }

        $petugas->update([
            'nama_petugas' => $data['nama_petugas'],
            'username' => strtolower($data['username']),
            'password' => $password ?? $petugas->password,
            'telp' => $data['telp'],
            'roles' => $data['roles'],
            'perumahan_id' => $data['perumahan_id'] ?? null, // Menangani perumahan_id yang tidak ada
        ]);

        Alert::success('Berhasil', 'Petugas berhasil diupdate!');
        return redirect()->route('petugas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_petugas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id_petugas)
    {

        if($id_petugas = 'id_petugas') {
            $id_petugas = $request->id_petugas;
        }

        $petugas = Petugas::find($id_petugas);

        $petugas->delete();

        if($request->ajax()) {
            return 'success';
        }

        return redirect()->route('petugas.index');
    }

}
