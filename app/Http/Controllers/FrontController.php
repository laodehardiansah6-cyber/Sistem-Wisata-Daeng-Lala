<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Kuliner;
use App\Models\Pemesanan;
use App\Models\Ulasan;
use App\Models\Promo; 
use App\Models\Galeri; 
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function fasilitas(Request $request)
    {
        $query = Fasilitas::query();
        if ($request->filled('cari')) { $query->where('nama_fasilitas', 'like', '%' . $request->cari . '%'); }
        if ($request->filled('status')) { $query->where('status', $request->status); }
        $fasilitas = $query->latest()->get();
        foreach ($fasilitas as $item) {
            $item->avg_rating = Ulasan::where('jenis', 'Fasilitas')->where('item_id', $item->id)->avg('rating');
        }
        $ulasan = Ulasan::with('user')->latest()->take(6)->get();
        return view('user.fasilitas', compact('fasilitas', 'ulasan'));
    }

    public function kuliner(Request $request)
    {
        $query = Kuliner::query();
        if ($request->filled('cari')) { $query->where('nama_menu', 'like', '%' . $request->cari . '%'); }
        if ($request->filled('status')) { $query->where('status', $request->status); }
        $kuliners = $query->latest()->get();
        foreach ($kuliners as $item) {
            $item->avg_rating = Ulasan::where('jenis', 'Makanan')->where('item_id', $item->id)->avg('rating');
        }
        $ulasan = Ulasan::with('user')->latest()->take(6)->get();
        return view('user.kuliner', compact('kuliners', 'ulasan'));
    }

    public function promo()
    {
        $promos = Promo::where('status', 'Aktif')->latest()->get();
        return view('promo', compact('promos'));
    }

    public function galeri()
    {
        $galeris = Galeri::latest()->get();
        return view('galeri', compact('galeris'));
    }

    public function booking()
    {
        return view('user.booking');
    }

    // --- TAMBAHAN MENU FAQ UNTUK USER (Hanya tampilkan yang sudah dijawab) ---
    public function faqUser()
    {
        $faqs = Faq::whereNotNull('jawaban')->latest()->get();
        return view('user.faq', compact('faqs'));
    }

    // --- MENERIMA PERTANYAAN BARU DARI PENGUNJUNG ---
    public function storeFaqUser(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
        ]);

        Faq::create([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => null, // Dikosongkan agar admin yang menjawab nanti
        ]);

        return redirect()->back()->with('success', 'Pertanyaan Anda berhasil dikirim! Silakan tunggu admin membalasnya.');
    }

    // --- CEK PROMO DAN CEK KUOTA HABIS ---
    public function cekPromo(Request $request)
    {
        $promo = Promo::where('kode_promo', $request->kode_promo)
                      ->where('status', 'Aktif')
                      ->first();

        if ($promo) {
            if ($promo->kuota > 0) {
                return response()->json([
                    'success' => true,
                    'diskon_persen' => $promo->diskon_persen,
                    'pesan' => 'Berhasil! Anda mendapat diskon ' . $promo->diskon_persen . '%. (Sisa Kuota: ' . $promo->kuota . ')'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'pesan' => 'Maaf, kuota untuk kode promo ini sudah habis.'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'pesan' => 'Kode promo tidak valid atau tidak ditemukan.'
            ]);
        }
    }

    // --- PROSES PEMESANAN & POTONG KUOTA ---
    public function storeBooking(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:Makanan,Fasilitas',
            'item_nama' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'total_harga' => 'required|integer|min:1',
            'nomor_wa' => 'required|string|max:20',
            'bukti_transfer' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
            'catatan' => 'nullable|string',
            'kode_promo_dipakai' => 'nullable|string' // Validasi tambahan
        ]);

        // JIKA ADA KODE PROMO, KURANGI KUOTANYA -1
        if ($request->filled('kode_promo_dipakai')) {
            $promo = Promo::where('kode_promo', $request->kode_promo_dipakai)
                          ->where('status', 'Aktif')
                          ->where('kuota', '>', 0)
                          ->first();
            
            if ($promo) {
                $promo->decrement('kuota'); // Script ajaib memotong kuota otomatis
            }
        }

        $path_file = null;
        if ($request->hasFile('bukti_transfer')) {
            $file = $request->file('bukti_transfer');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/bukti_transfer'), $nama_file);
            $path_file = 'uploads/bukti_transfer/' . $nama_file;
        }

        $id_pesanan = 'ORD-' . date('Ymd') . '-' . rand(1000, 9999);

        Pemesanan::create([
            'id_pesanan' => $id_pesanan,
            'user_id' => Auth::id(),
            'jenis' => $request->jenis,
            'item_nama' => $request->item_nama,
            'jumlah' => $request->jumlah,
            'total_harga' => $request->total_harga,
            'nomor_wa' => $request->nomor_wa,
            'status_pesanan' => 'Pending',
            'status_pembayaran' => 'Belum Bayar', 
            'metode_pembayaran' => 'Transfer Bank',
            'bukti_transfer' => $path_file, 
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('user.riwayat')->with('success', 'Pesanan berhasil dikirim! Silakan tunggu konfirmasi.');
    }

    public function riwayatPesanan()
    {
        $pesanans = Pemesanan::where('user_id', Auth::id())->latest()->get();
        return view('user.riwayat', compact('pesanans'));
    }
}
