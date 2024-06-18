<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Perumahan; // Sesuaikan dengan nama model yang benar
use RealRashid\SweetAlert\Facades\Alert;

class PerumahanController extends Controller
{
    public function index()
    {
        $perumahans = Perumahan::all();

        return view('pages.admin.perumahan.index', compact('perumahans'));
    }

    public function create()
    {
        return view('pages.admin.perumahan.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'nama' => ['required', 'string', 'max:255'],
            // Tambahkan validasi sesuai kebutuhan
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        Perumahan::create([
            'nama' => $data['nama'],
            // Tambahkan field lain yang perlu disimpan
        ]);

        Alert::success('Berhasil', 'Perumahan telah ditambahkan!');
        return redirect()->route('perumahan.index');
    }

    public function edit($id)
    {
        $perumahan = Perumahan::findOrFail($id);

        return view('pages.admin.perumahan.edit', compact('perumahan'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'nama' => ['required', 'string', 'max:255'],
            // Tambahkan validasi sesuai kebutuhan
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        $perumahan = Perumahan::findOrFail($id);
        $perumahan->update([
            'nama' => $data['nama'],
            // Update field lain yang diperlukan
        ]);

        Alert::success('Berhasil', 'Perumahan berhasil diupdate!');
        return redirect()->route('perumahan.index');
    }

    public function destroy($id)
    {
        $perumahan = Perumahan::findOrFail($id);
        $perumahan->delete();

        Alert::success('Berhasil', 'Perumahan berhasil dihapus!');
        return redirect()->route('perumahan.index');
    }
}
