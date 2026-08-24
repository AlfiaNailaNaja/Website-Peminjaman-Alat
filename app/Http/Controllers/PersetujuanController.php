<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Services\PeminjamanService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersetujuanController extends Controller
{
    public function __construct(private PeminjamanService $layanan)
    {
    }

    /**
     * Menampilkan daftar antrian pengajuan peminjaman yang perlu disetujui/ditolak.
     */
    public function antrian()
    {
        $daftarPengajuan = $this->layanan->antrianPengajuan();

        return view('persetujuan.antrian', compact('daftarPengajuan'));
    }

    /**
     * Menampilkan rincian detail dari satu pengajuan peminjaman.
     */
    public function rincian(Peminjaman $peminjaman)
    {
        $peminjaman->load(['user', 'detail.alat']);

        return view('persetujuan.rincian', compact('peminjaman'));
    }

    /**
     * Menyetujui pengajuan peminjaman alat.
     */
    public function setujui(Request $request, Peminjaman $peminjaman)
    {
        $data = $request->validate([
            'tgl_harus_kembali' => [
                'required',
                'date',
                'after_or_equal:' . $peminjaman->tgl_pinjam->toDateString(),
            ],
        ]);

        try {
            $this->layanan->setujui(
                $peminjaman,
                Auth::id(),
                $data['tgl_harus_kembali']
            );
        } catch (QueryException $e) {
            return back()->with('gagal', $this->pesanRamah($e));
        }

        return redirect()
            ->route('persetujuan.antrian')
            ->with('sukses', 'Peminjaman ' . $peminjaman->kode_pinjam . ' disetujui.');
    }

    /**
     * Menolak pengajuan peminjaman alat.
     */
    public function tolak(Request $request, Peminjaman $peminjaman)
    {
        $data = $request->validate([
            'alasan_tolak' => ['required', 'string', 'min:5', 'max:500'],
        ], [
            'alasan_tolak.required' => 'Alasan penolakan wajib diisi.',
            'alasan_tolak.min'      => 'Alasan penolakan minimal 5 karakter.',
            'alasan_tolak.max'      => 'Alasan penolakan maksimal 500 karakter.',
        ]);

        $this->layanan->tolak($peminjaman, Auth::id(), $data['alasan_tolak']);

        return redirect()
            ->route('persetujuan.antrian')
            ->with('sukses', 'Peminjaman ' . $peminjaman->kode_pinjam . ' ditolak.');
    }

    /**
     * Mengambil pesan error dari Stored Procedure untuk ditampilkan secara ramah ke UI.
     */
    private function pesanRamah(QueryException $e): string
    {
        $pesanAsli = $e->errorInfo[2] ?? '';

        return $pesanAsli !== ''
            ? $pesanAsli
            : 'Persetujuan gagal diproses. Silakan coba lagi.';
    }
}