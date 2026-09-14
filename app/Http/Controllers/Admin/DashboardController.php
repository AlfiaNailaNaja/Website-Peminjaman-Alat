<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Parameter Filter (Default: Bulan & Tahun Ini)
        $bulanFilter = $request->get('bulan', now()->month);
        $tahunFilter = $request->get('tahun', now()->year);

        // 1. Stat Cards Utama
        $totalAlat     = Alat::count();
        $totalKategori = Kategori::count();
        $totalPengguna = User::count();
        
        // Total Peminjaman Selesai All-Time
        $totalSelesaiAllTime = Peminjaman::where('status', 'selesai')->count();

        // Total Peminjaman Selesai Berdasarkan Filter Bulan & Tahun
        $totalSelesaiBulanIni = Peminjaman::where('status', 'selesai')
            ->whereYear('updated_at', $tahunFilter)
            ->whereMonth('updated_at', $bulanFilter)
            ->count();

        // 2. Data Grafik Harian (Tren Transaksi Selesai)
        $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulanFilter, $tahunFilter);
        $tanggalLabels = [];
        $selesaiPerHari = [];

        for ($h = 1; $h <= $jumlahHari; $h++) {
            $tanggalLabels[] = $h . ' ' . date('M', mktime(0, 0, 0, $bulanFilter, 10));
            
            $count = Peminjaman::where('status', 'selesai')
                ->whereYear('updated_at', $tahunFilter)
                ->whereMonth('updated_at', $bulanFilter)
                ->whereDay('updated_at', $h)
                ->count();

            $selesaiPerHari[] = $count;
        }

        // 3. Rincian Pengembalian Selesai (Berdasarkan kolom hari_terlambat & denda_kerusakan)
        $kategoriPengembalian = [
            'Tepat Waktu' => Pengembalian::whereHas('peminjaman', function ($q) use ($bulanFilter, $tahunFilter) {
                $q->where('status', 'selesai')
                  ->whereYear('updated_at', $tahunFilter)
                  ->whereMonth('updated_at', $bulanFilter);
            })->where('hari_terlambat', 0)->count(),

            'Terlambat' => Pengembalian::whereHas('peminjaman', function ($q) use ($bulanFilter, $tahunFilter) {
                $q->where('status', 'selesai')
                  ->whereYear('updated_at', $tahunFilter)
                  ->whereMonth('updated_at', $bulanFilter);
            })->where('hari_terlambat', '>', 0)->count(),

            'Ada Kerusakan' => Pengembalian::whereHas('peminjaman', function ($q) use ($bulanFilter, $tahunFilter) {
                $q->where('status', 'selesai')
                  ->whereYear('updated_at', $tahunFilter)
                  ->whereMonth('updated_at', $bulanFilter);
            })->where('denda_kerusakan', '>', 0)->count(),
        ];

        // 4. Data Top 5 Alat Paling Sering Selesai Dipinjam (Lewat relasi detailPeminjaman)
        $topAlatSelesai = Alat::whereHas('detailPeminjaman.peminjaman', function ($q) use ($bulanFilter, $tahunFilter) {
            $q->where('status', 'selesai')
              ->whereYear('updated_at', $tahunFilter)
              ->whereMonth('updated_at', $bulanFilter);
        })
        ->withCount(['detailPeminjaman as peminjaman_count' => function ($q) use ($bulanFilter, $tahunFilter) {
            $q->whereHas('peminjaman', function ($p) use ($bulanFilter, $tahunFilter) {
                $p->where('status', 'selesai')
                  ->whereYear('updated_at', $tahunFilter)
                  ->whereMonth('updated_at', $bulanFilter);
            });
        }])
        ->orderBy('peminjaman_count', 'desc')
        ->take(5)
        ->get();

        $topAlatLabels = $topAlatSelesai->pluck('nama');
        $topAlatData   = $topAlatSelesai->pluck('peminjaman_count');

        return view('dasbor.admin', compact(
            'totalAlat',
            'totalKategori',
            'totalPengguna',
            'totalSelesaiAllTime',
            'totalSelesaiBulanIni',
            'bulanFilter',
            'tahunFilter',
            'tanggalLabels',
            'selesaiPerHari',
            'kategoriPengembalian',
            'topAlatLabels',
            'topAlatData'
        ));
    }
}