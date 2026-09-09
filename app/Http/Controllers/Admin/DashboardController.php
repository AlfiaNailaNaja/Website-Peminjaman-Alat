<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Data Ringkasan untuk Stat Cards
        $totalAlat = Alat::count();
        $totalKategori = Kategori::count();
        $totalPengguna = User::count();
        $totalPending = Peminjaman::where('status', 'diajukan')->count();

        // 2. Data untuk Grafik (Jumlah Alat per Kategori)
        // 2. Data untuk Grafik (Jumlah Alat per Kategori)
        $kategoriData = Kategori::withCount('daftarAlat')->get();

        $chartLabels = $kategoriData->pluck('nama'); // Menggunakan kolom 'nama' sesuai $fillable
        $chartData = $kategoriData->pluck('daftar_alat_count'); // Laravel otomatis membuat nama atribut ini

        return view('dasbor.admin', compact(
    'totalAlat',
    'totalKategori',
    'totalPengguna',
    'totalPending',
    'chartLabels',
    'chartData'
    ));
    }
}
