<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Enums\StatusPeminjaman;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. Total Alat Sedang Dipinjam
        $totalDipinjam = Peminjaman::where('user_id', $userId)
            ->where('status', StatusPeminjaman::Dipinjam)
            ->count();

        // 2. Total Menunggu Persetujuan
        $totalPending = Peminjaman::where('user_id', $userId)
            ->where('status', StatusPeminjaman::Diajukan)
            ->count();

        // 3. Total Menunggu Verifikasi Pengembalian
        $totalMenungguVerifikasi = Peminjaman::where('user_id', $userId)
            ->where('status', StatusPeminjaman::MenungguVerifikasi)
            ->count();

        // 4. Total Peminjaman Selesai
        $totalSelesai = Peminjaman::where('user_id', $userId)
            ->where('status', StatusPeminjaman::Selesai)
            ->count();

        return view('dasbor.peminjam', compact(
            'totalDipinjam',
            'totalPending',
            'totalMenungguVerifikasi',
            'totalSelesai'
        ));
    }
}