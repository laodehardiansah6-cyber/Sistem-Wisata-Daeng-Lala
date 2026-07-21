<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    // TAMPILAN ADMIN: Melihat daftar semua FAQ
    public function index()
    {
        $faqs = Faq::latest()->get();
        return view('admin.faq.index', compact('faqs'));
    }

    // TAMPILAN ADMIN: Form tambah FAQ baru
    public function create()
    {
        return view('admin.faq.create');
    }

    // LOGIKA ADMIN: Menyimpan FAQ baru ke database
    public function store(Request $request)
    {
        // Validasi diubah agar jawaban boleh kosong (nullable)
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'nullable|string',
        ]);

        Faq::create([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
        ]);

        return redirect()->route('faq.index')->with('success', 'FAQ berhasil ditambahkan!');
    }

    // (Opsional) TAMPILAN ADMIN: Lihat 1 detail FAQ 
    public function show(Faq $faq)
    {
        return view('admin.faq.show', compact('faq'));
    }

    // TAMPILAN ADMIN: Form edit FAQ
    public function edit(Faq $faq)
    {
        return view('admin.faq.edit', compact('faq'));
    }

    // LOGIKA ADMIN: Menyimpan perubahan FAQ
    public function update(Request $request, Faq $faq)
    {
        // Tetap wajibkan jawaban diisi saat proses Update/Menjawab
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string', 
        ]);

        $faq->update([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
        ]);

        return redirect()->route('faq.index')->with('success', 'FAQ berhasil diperbarui dan dijawab!');
    }

    // LOGIKA ADMIN: Menghapus FAQ
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('faq.index')->with('success', 'FAQ berhasil dihapus!');
    }
}
