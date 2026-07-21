<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest()->get();
        return view('admin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'judul_foto' => 'nullable|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Upload Gambar 
        $path_gambar = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/galeri'), $nama_file);
            $path_gambar = 'uploads/galeri/' . $nama_file;
        }

        // 3. Simpan ke Database
        Galeri::create([
            'judul_foto' => $request->judul_foto,
            'gambar' => $path_gambar,
        ]);

        return redirect()->route('galeri.index')->with('success', 'Foto berhasil ditambahkan ke Galeri!');
    }

    // --- TAMBAHAN FUNGSI EDIT DAN UPDATE ---
    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'judul_foto' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if (File::exists(public_path($galeri->gambar))) {
                File::delete(public_path($galeri->gambar));
            }
            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/galeri'), $nama_file);
            $galeri->gambar = 'uploads/galeri/' . $nama_file;
        }

        $galeri->judul_foto = $request->judul_foto;
        $galeri->save();

        return redirect()->route('galeri.index')->with('success', 'Foto Galeri berhasil diperbarui!');
    }
    // ---------------------------------------

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);
        
        // Hapus file gambar dari folder public jika ada
        if (File::exists(public_path($galeri->gambar))) {
            File::delete(public_path($galeri->gambar));
        }

        $galeri->delete();
        return redirect()->route('galeri.index')->with('success', 'Foto berhasil dihapus dari Galeri!');
    }
}
