<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Kuliner;
use App\Models\Pemesanan;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    // Halaman Katalog Fasilitas
    public function fasilitas(Request $request)
    {
        $query = Fasilitas::query();

        if ($request->filled('cari')) {
            $query->where('nama_fasilitas', 'like', '%' . $request->cari . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $fasilitas = $query->latest()->get();

        foreach ($fasilitas as $item) {
            $item->avg_rating = Ulasan::where('jenis', 'Fasilitas')->where('item_id', $item->id)->avg('rating');
        }

        $ulasan = Ulasan::with('user')->latest()->take(6)->get();

        return view('user.fasilitas', compact('fasilitas', 'ulasan'));
    }

    // Halaman Katalog Kuliner
    public function kuliner(Request $request)
    {
        $query = Kuliner::query();

        if ($request->filled('cari')) {
            $query->where('nama_menu', 'like', '%' . $request->cari . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $kuliners = $query->latest()->get();

        foreach ($kuliners as $item) {
            $item->avg_rating = Ulasan::where('jenis', 'Makanan')->where('item_id', $item->id)->avg('rating');
        }

        $ulasan = Ulasan::with('user')->latest()->take(6)->get();

        return view('user.kuliner', compact('kuliners', 'ulasan'));
    }

    // Menampilkan Form Pemesanan (Booking)
    public function booking()
    {
        return view('user.booking');
    }

    // Memproses Data Pemesanan & Foto Bukti Transfer
    public function storeBooking(Request $request)
    {
        // 1. Validasi Input (Termasuk nomor_wa)
        $request->validate([
            'jenis' => 'required|in:Makanan,Fasilitas',
            'item_nama' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'total_harga' => 'required|integer|min:1',
            'nomor_wa' => 'required|string|max:20',
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'catatan' => 'nullable|string'
        ]);

        // 2. Upload Gambar
        $file = $request->file('bukti_transfer');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('uploads/bukti_transfer'), $nama_file);

        // 3. ID Pesanan Otomatis
        $id_pesanan = 'ORD-' . date('Ymd') . '-' . rand(1000, 9999);

        // 4. Simpan ke Database
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
            'bukti_transfer' => 'uploads/bukti_transfer/' . $nama_file,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('user.riwayat')->with('success', 'Pesanan berhasil dikirim! Silakan tunggu konfirmasi.');
    }

    // Halaman Riwayat Pesanan
    public function riwayatPesanan()
    {
        $pesanans = Pemesanan::where('user_id', Auth::id())->latest()->get();
        return view('user.riwayat', compact('pesanans'));
    }
}
