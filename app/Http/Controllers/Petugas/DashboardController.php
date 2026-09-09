<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Enums\StatusPeminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Antrean Peminjaman Menunggu Persetujuan (status: diajukan)
        $totalAntrean = Peminjaman::where('status', StatusPeminjaman::Diajukan)->count();

        // 2. Peminjaman Aktif (status: dipinjam)
        $totalDipinjam = Peminjaman::where('status', StatusPeminjaman::Dipinjam)->count();

        // 3. Menunggu Verifikasi Pengembalian (status: menunggu_verifikasi)
        $totalPengembalian = Peminjaman::where('status', StatusPeminjaman::MenungguVerifikasi)->count();

        return view('dasbor.petugas', compact('totalAntrean', 'totalDipinjam', 'totalPengembalian'));
    }
}