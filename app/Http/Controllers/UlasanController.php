<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function store(Request $request)
    {
        // Pastikan data yang dikirim valid
        $request->validate([
            'jenis' => 'required|in:Makanan,Fasilitas',
            'item_id' => 'required|integer',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string'
        ]);

        // Simpan ke database
        Ulasan::create([
            'user_id' => Auth::id(),
            'jenis' => $request->jenis,
            'item_id' => $request->item_id,
            'rating' => $request->rating,
            'komentar' => $request->komentar
        ]);

        // Kembalikan pengunjung ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Terima kasih! Ulasan dan rating Anda berhasil disimpan.');
    }
}
