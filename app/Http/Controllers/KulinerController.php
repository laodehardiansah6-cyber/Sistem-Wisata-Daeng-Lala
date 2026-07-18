<?php

namespace App\Http\Controllers;

use App\Models\Kuliner;
use Illuminate\Http\Request;

class KulinerController extends Controller
{
    public function index()
    {
        $kuliners = Kuliner::latest()->get();
        return view('kuliner.index', compact('kuliners'));
    }

    public function create()
    {
        return view('kuliner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'status' => 'required|in:Tersedia,Habis',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // JALAN PINTAS ANTI-ERROR GAMBAR (Langsung ke public/uploads/kuliner)
        $file = $request->file('gambar');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('uploads/kuliner'), $nama_file);

        Kuliner::create([
            'nama_menu' => $request->nama_menu,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'status' => $request->status,
            'gambar' => 'uploads/kuliner/' . $nama_file,
        ]);

        return redirect()->route('kuliner.index')->with('success', 'Menu kuliner berhasil ditambahkan!');
    }

    // FITUR EDIT - Menampilkan Form
    public function edit($id)
    {
        $kuliner = Kuliner::findOrFail($id);
        return view('kuliner.edit', compact('kuliner'));
    }

    // FITUR UPDATE - Memproses Data Baru
    public function update(Request $request, $id)
    {
        $kuliner = Kuliner::findOrFail($id);

        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'status' => 'required|in:Tersedia,Habis',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = [
            'nama_menu' => $request->nama_menu,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'status' => $request->status,
        ];

        // Jika upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if(file_exists(public_path($kuliner->gambar))){
                unlink(public_path($kuliner->gambar));
            }
            
            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/kuliner'), $nama_file);
            $data['gambar'] = 'uploads/kuliner/' . $nama_file;
        }

        $kuliner->update($data);

        return redirect()->route('kuliner.index')->with('success', 'Menu kuliner berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kuliner = Kuliner::findOrFail($id);
        
        // Hapus fisik gambar
        if(file_exists(public_path($kuliner->gambar))){
            unlink(public_path($kuliner->gambar));
        }
        
        $kuliner->delete();
        
        return redirect()->route('kuliner.index')->with('success', 'Menu kuliner berhasil dihapus!');
    }
}
