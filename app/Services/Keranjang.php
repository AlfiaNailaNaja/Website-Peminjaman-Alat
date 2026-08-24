<?php

namespace App\Services;

use App\Models\Alat;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class Keranjang
{
    private const KUNCI_SESSION = 'keranjang';

    /**
     * Mengambil data keranjang mentah dari session (Format: [alat_id => jumlah]).
     */
    public function isiMentah(): array
    {
        return Session::get(self::KUNCI_SESSION, []);
    }

    /**
     * Mengambil daftar alat di keranjang beserta detailnya.
     */
    public function isi(): Collection
    {
        $isiMentah = $this->isiMentah();

        if (empty($isiMentah)) {
            return collect();
        }

        // Query mengambil alat berdasarkan ID yang ada di keranjang
        $daftarAlat = Alat::with('kategori')
            ->whereIn('id', array_keys($isiMentah))
            ->get();

        return $daftarAlat->map(function ($alat) use ($isiMentah) {
            // Memastikan penanganan key aman baik string maupun integer
            $jumlah = $isiMentah[$alat->id] ?? $isiMentah[(string) $alat->id] ?? 0;

            return (object) [
                'alat' => $alat,
                'jumlah' => $jumlah,
            ];
        })->filter(function ($item) {
            // Filter jika ada jumlah yang 0
            return $item->jumlah > 0;
        });
    }

    /**
     * Menambahkan alat ke dalam keranjang.
     */
    public function tambah(Alat $alat, int $jumlah): void
    {
        $isiMentah = $this->isiMentah();
        $alatId = $alat->id;

        $jumlahLama = $isiMentah[$alatId] ?? 0;
        $jumlahBaru = $jumlahLama + $jumlah;

        // Memastikan jumlah tidak melebihi stok yang tersedia
        $isiMentah[$alatId] = min($jumlahBaru, $alat->stok_tersedia);

        Session::put(self::KUNCI_SESSION, $isiMentah);
        Session::save(); // Memastikan session langsung tersimpan
    }

    /**
     * Mengubah jumlah alat di dalam keranjang.
     */
    public function ubahJumlah(Alat $alat, int $jumlah): void
    {
        $isiMentah = $this->isiMentah();
        $alatId = $alat->id;

        if (! isset($isiMentah[$alatId])) {
            return;
        }

        $isiMentah[$alatId] = min($jumlah, $alat->stok_tersedia);

        Session::put(self::KUNCI_SESSION, $isiMentah);
        Session::save();
    }

    /**
     * Menghapus 1 barang dari keranjang berdasarkan ID alat.
     */
    public function hapus(int $alatId): void
    {
        $isiMentah = $this->isiMentah();
        unset($isiMentah[$alatId]);

        Session::put(self::KUNCI_SESSION, $isiMentah);
        Session::save();
    }

    /**
     * Mengosongkan seluruh isi keranjang.
     */
    public function kosongkan(): void
    {
        Session::forget(self::KUNCI_SESSION);
        Session::save();
    }

    /**
     * Menghitung berapa jenis item yang ada di keranjang.
     */
    public function jumlahBaris(): int
    {
        return count($this->isiMentah());
    }

    /**
     * Cek apakah keranjang kosong.
     */
    public function kosong(): bool
    {
        return $this->jumlahBaris() === 0;
    }
}