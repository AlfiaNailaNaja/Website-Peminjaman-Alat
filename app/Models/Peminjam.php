<?php

namespace App\Models;

use App\Enums\StatusPeminjaman;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Peminjaman extends Model
{
    protected $guarded = ['id'];

    /**
     * Casting tipe data kolom.
     */
    protected $casts = [
        'status' => StatusPeminjaman::class,
        'tgl_pinjam' => 'datetime',
        'tgl_harus_kembali' => 'datetime',
    ];

    /**
     * Relasi ke User (sebagai Peminjam).
     */
    public function peminjam(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke User (sebagai Petugas yang menyetujui/memproses).
     */
    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    /**
     * Relasi ke Detail Peminjaman (banyak barang dalam 1 transaksi).
     */
    public function detail(): HasMany
    {
        return $this->hasMany(DetailPeminjaman::class, 'peminjaman_id');
    }

    /**
     * Relasi ke Transaksi Pengembalian.
     */
    public function pengembalian(): HasOne
    {
        return $this->hasOne(Pengembalian::class, 'peminjaman_id');
    }

    /**
     * Pengecekan apakah peminjaman sudah melewati tenggat waktu pengembalian.
     */
    public function lewatTenggat(): bool
    {
        return in_array($this->status, [
            StatusPeminjaman::Dipinjam,
            StatusPeminjaman::MenungguVerifikasi,
        ], true) && $this->tgl_harus_kembali && $this->tgl_harus_kembali->isPast();
    }
}