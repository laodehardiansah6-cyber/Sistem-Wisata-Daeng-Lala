<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::latest()->get();
        return view('admin.promo.index', compact('promos'));
    }

    public function create()
    {
        return view('admin.promo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_promo' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kode_promo' => 'nullable|string|max:50',
            'diskon_persen' => 'required|numeric|min:0|max:100',
            'kuota' => 'required|integer|min:0', // Validasi Kuota
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:Aktif,Tidak Aktif'
        ]);

        $path_gambar = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/promo'), $nama_file);
            $path_gambar = 'uploads/promo/' . $nama_file;
        }

        Promo::create([
            'judul_promo' => $request->judul_promo,
            'deskripsi' => $request->deskripsi,
            'kode_promo' => $request->kode_promo,
            'diskon_persen' => $request->diskon_persen,
            'kuota' => $request->kuota, // Simpan Kuota
            'status' => $request->status,
            'gambar' => $path_gambar,
        ]);

        return redirect()->route('promo.index')->with('success', 'Promo berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $promo = Promo::findOrFail($id);
        return view('admin.promo.edit', compact('promo'));
    }

    public function update(Request $request, $id)
    {
        $promo = Promo::findOrFail($id);

        $request->validate([
            'judul_promo' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kode_promo' => 'nullable|string|max:50',
            'diskon_persen' => 'required|numeric|min:0|max:100',
            'kuota' => 'required|integer|min:0', // Validasi Kuota
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:Aktif,Tidak Aktif'
        ]);

        if ($request->hasFile('gambar')) {
            if (File::exists(public_path($promo->gambar))) {
                File::delete(public_path($promo->gambar));
            }
            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/promo'), $nama_file);
            $promo->gambar = 'uploads/promo/' . $nama_file;
        }

        $promo->judul_promo = $request->judul_promo;
        $promo->deskripsi = $request->deskripsi;
        $promo->kode_promo = $request->kode_promo;
        $promo->diskon_persen = $request->diskon_persen;
        $promo->kuota = $request->kuota; // Update Kuota
        $promo->status = $request->status;
        $promo->save();

        return redirect()->route('promo.index')->with('success', 'Promo berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $promo = Promo::findOrFail($id);
        if (File::exists(public_path($promo->gambar))) {
            File::delete(public_path($promo->gambar));
        }
        $promo->delete();
        return redirect()->route('promo.index')->with('success', 'Promo berhasil dihapus!');
    }
}
