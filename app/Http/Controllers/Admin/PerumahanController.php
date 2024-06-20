<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Perumahan;
use RealRashid\SweetAlert\Facades\Alert;

class PerumahanController extends Controller
{
    public function index()
    {
        $perumahans = Perumahan::all(); // Mengambil semua data perumahan

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
            'nama_perumahan' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:500'],
            'contact' => ['nullable', 'string', 'max:20'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        Perumahan::create($data);

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
            'nama_perumahan' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:500'],
            'contact' => ['nullable', 'string', 'max:20'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $perumahan = Perumahan::findOrFail($id);
        $perumahan->update($data);

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
