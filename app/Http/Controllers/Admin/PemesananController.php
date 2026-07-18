<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    // 1. Menampilkan Halaman Pesanan Masuk (Aktif)
    public function index()
    {
        $pemesanans = Pemesanan::with('user')->latest()->get();
        // Mengarahkan ke file resources/views/admin/pemesanan/index.blade.php
        return view('admin.pemesanan.index', compact('pemesanans'));
    }

    // 2. Mengupdate Status Pesanan & Pembayaran
    public function updateStatus(Request $request, $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $aksi = $request->input('aksi'); 

        // Aksi Terima & Lunas
        if ($aksi == 'terima') {
            $pemesanan->update([
                'status_pesanan' => 'Sukses',
                'status_pembayaran' => 'Lunas'
            ]);
            return redirect()->back()->with('success', 'Pesanan DITERIMA & LUNAS.');
        }

        // Aksi Terima & Bayar Setengah (DP)
        if ($aksi == 'terima_setengah') {
            $pemesanan->update([
                'status_pesanan' => 'Sukses',
                'status_pembayaran' => 'Bayar Setengah'
            ]);
            return redirect()->back()->with('success', 'Pesanan DITERIMA (Bayar Setengah / DP).');
        }

        // Aksi Tolak Pesanan
        if ($aksi == 'tolak') {
            $pemesanan->update([
                'status_pesanan' => 'Batal',
                'status_pembayaran' => 'Belum Bayar'
            ]);
            return redirect()->back()->with('success', 'Pesanan DITOLAK.');
        }

        // Fallback validasi manual
        $request->validate([
            'status_pesanan' => 'nullable|in:Pending,Sukses,Batal',
            'status_pembayaran' => 'nullable|in:Belum Bayar,Bayar Setengah,Lunas',
        ]);

        $pemesanan->update([
            'status_pesanan' => $request->status_pesanan ?? $pemesanan->status_pesanan,
            'status_pembayaran' => $request->status_pembayaran ?? $pemesanan->status_pembayaran,
        ]);

        return redirect()->back()->with('success', 'Status pesanan diperbarui.');
    }

    // 3. Menampilkan Halaman Riwayat Transaksi (Selesai/Batal)
    public function riwayat()
    {
        // Ambil data yang sudah Lunas atau Batal, urutkan dari yang terbaru
        $pemesanans = Pemesanan::with('user')
                        ->where('status_pembayaran', 'Lunas')
                        ->orWhere('status_pesanan', 'Batal')
                        ->orderBy('updated_at', 'desc')
                        ->get();

        // Mengarahkan ke file resources/views/admin/pemesanan/riwayat.blade.php
        return view('admin.pemesanan.riwayat', compact('pemesanans'));
    }
}
