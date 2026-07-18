<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::latest()->get();
        return view('fasilitas.index', compact('fasilitas'));
    }

    public function create()
    {
        return view('fasilitas.create');
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'kategori' => 'required|string',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'satuan' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // JALAN PINTAS ANTI-ERROR: Simpan langsung ke folder public/uploads/fasilitas
        $file = $request->file('gambar');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('uploads/fasilitas'), $nama_file);

        // Simpan data ke database
        Fasilitas::create([
            'nama_fasilitas' => $request->nama_fasilitas,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'satuan' => $request->satuan,
            'gambar' => 'uploads/fasilitas/' . $nama_file, // Format teks database diperbarui
        ]);

        return redirect()->route('fasilitas.index')->with('success', 'Data fasilitas berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        
        // Hapus file gambar secara fisik dari folder public/uploads
        if(file_exists(public_path($fasilitas->gambar))){
            unlink(public_path($fasilitas->gambar));
        }
        
        $fasilitas->delete();
        
        return redirect()->route('fasilitas.index')->with('success', 'Data fasilitas berhasil dihapus!');
    }
    // Menampilkan halaman form edit
    public function edit($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        return view('fasilitas.edit', compact('fasilitas'));
    }

    // Memproses data yang diubah
    public function update(Request $request, $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        // Validasi data (gambar boleh kosong jika tidak ingin diganti)
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'kategori' => 'required|string',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'satuan' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = [
            'nama_fasilitas' => $request->nama_fasilitas,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'satuan' => $request->satuan,
        ];

        // Jika admin mengupload gambar baru saat diedit
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama agar memori tidak penuh
            if(file_exists(public_path($fasilitas->gambar))){
                unlink(public_path($fasilitas->gambar));
            }
            
            // Simpan gambar baru dengan jalan pintas anti-error
            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/fasilitas'), $nama_file);
            $data['gambar'] = 'uploads/fasilitas/' . $nama_file;
        }

        // Update data ke database
        $fasilitas->update($data);

        return redirect()->route('fasilitas.index')->with('success', 'Data fasilitas berhasil diperbarui!');
    }
}