<?php
namespace App\Http\Controllers;
use App\Models\Promo;
use Illuminate\Http\Request;

class UserPromoController extends Controller
{
    public function index()
    {
        // Mengambil semua promo yang statusnya aktif
        $promos = Promo::where('status_aktif', true)->latest()->get();
        return view('user.promo.index', compact('promos'));
    }
}
