<?php

namespace App\Models;

use App\Enums\StatusPeminjaman;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Peminjaman extends Model
{
    use HasFactory;

    /**
     * Secara eksplisit menentukan nama tabel di database
     * untuk mencegah error 'peminjamen' doesn't exist.
     */
    protected $table = 'peminjaman';

    protected $guarded = ['id'];

    protected $casts = [
        'status' => StatusPeminjaman::class,
        'tgl_pinjam' => 'datetime',
        'tgl_harus_kembali' => 'datetime',
        'tgl_diajukan_kembali' => 'datetime',
    ];

    /**
     * Relasi ke peminjam (User)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Alias relasi ke peminjam.
     */
    public function peminjam(): BelongsTo
    {
        return $this->user();
    }

    /**
     * Relasi ke petugas yang memproses peminjaman.
     */
    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    /**
     * Relasi ke detail barang/alat yang dipinjam
     */
    public function detail(): HasMany
    {
        return $this->hasMany(DetailPeminjaman::class, 'peminjaman_id');
    }

    /**
     * Helper method untuk mengecek apakah peminjaman sudah melewati tenggat waktu.
     */
    public function lewatTenggat(): bool
    {
        if (in_array($this->status, [StatusPeminjaman::Dipinjam, StatusPeminjaman::MenungguVerifikasi])) {
            return $this->tgl_harus_kembali && $this->tgl_harus_kembali->isPast();
        }

        return false;
    }
}