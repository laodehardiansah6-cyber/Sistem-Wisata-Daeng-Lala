<?php

use App\Http\Controllers\UlasanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\KulinerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PemesananController;
use App\Http\Controllers\Admin\UlasanController as AdminUlasanController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\FaqController; 
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () { return view('welcome'); });

// Rute Google Login 
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::middleware(['auth'])->group(function () {
    
    // --- Pengecekan Hak Akses saat ke Dashboard ---
    Route::get('/dashboard', function () { 
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('dashboard'); 
    })->name('dashboard');
    // -----------------------------------------------------------------
    
    // Rute Pengunjung (User)
    Route::get('/katalog-fasilitas', [FrontController::class, 'fasilitas'])->name('user.fasilitas');
    Route::get('/katalog-kuliner', [FrontController::class, 'kuliner'])->name('user.kuliner');
    
    // --- TAMBAHAN RUTE PENGUNJUNG (PROMO, GALERI & FAQ) ---
    Route::get('/promo', [FrontController::class, 'promo'])->name('user.promo');
    Route::get('/galeri', [FrontController::class, 'galeri'])->name('user.galeri');
    
    Route::get('/faq', [FrontController::class, 'faqUser'])->name('user.faq'); // <-- Rute Lihat FAQ User
    Route::post('/faq', [FrontController::class, 'storeFaqUser'])->name('user.faq.store'); // <-- Rute Kirim Pertanyaan Baru
    
    Route::get('/booking', [FrontController::class, 'booking'])->name('user.booking');
    Route::post('/booking', [FrontController::class, 'storeBooking'])->name('user.booking.store');
    
    // --- TAMBAHAN RUTE API CEK PROMO ---
    Route::post('/cek-promo', [FrontController::class, 'cekPromo'])->name('cek.promo');
    
    // Rute Simpan Ulasan/Rating
    Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');
    
    // Rute Halaman Riwayat/Keranjang Pengunjung
    Route::get('/pesanan-saya', [FrontController::class, 'riwayatPesanan'])->name('user.riwayat');
    
    // Rute Admin
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/dashboard', function () { 
            $data = [
                'total_fasilitas' => \App\Models\Fasilitas::count(),
                'total_kuliner' => \App\Models\Kuliner::count(),
                'total_pesanan' => \App\Models\Pemesanan::where('status_pesanan', 'Pending')->count(),
                'total_ulasan' => \App\Models\Ulasan::count(),
            ];
            return view('admin.dashboard', $data); 
        })->name('admin.dashboard');
        
        Route::get('/admin/pemesanan', [PemesananController::class, 'index'])->name('admin.pemesanan');
        Route::patch('/admin/pemesanan/{id}/status', [PemesananController::class, 'updateStatus'])->name('admin.pemesanan.status');
        
        // Rute Riwayat Transaksi Admin
        Route::get('/admin/riwayat-transaksi', [PemesananController::class, 'riwayat'])->name('admin.pemesanan.riwayat');
        
        // Rute Ulasan Admin
        Route::get('/admin/ulasan', [AdminUlasanController::class, 'index'])->name('admin.ulasan.index');
        Route::delete('/admin/ulasan/{id}', [AdminUlasanController::class, 'destroy'])->name('admin.ulasan.destroy');
        
        // CRUD Fasilitas & Kuliner
        Route::resource('/admin/fasilitas', FasilitasController::class);
        Route::resource('/admin/kuliner', KulinerController::class);

        // --- TAMBAHAN RUTE ADMIN (PROMO, GALERI, FAQ) ---
        Route::resource('/admin/promo', PromoController::class);
        Route::resource('/admin/galeri', GaleriController::class);
        Route::resource('/admin/faq', FaqController::class); // <-- Rute FAQ Admin

        Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
        Route::patch('/admin/users/{user}/update-role', [UserController::class, 'updateRole'])->name('admin.users.update');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
