<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function index()
    {
        // Mengambil semua data ulasan dari database
        $ulasans = \App\Models\Ulasan::all(); 
    
        // Pastikan file ini ada di: resources/views/admin/ulasan/index.blade.php
        return view('admin.ulasan.index', compact('ulasans'));
    }

    public function destroy($id)
    {
        Ulasan::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Ulasan berhasil dihapus.');
    }
}