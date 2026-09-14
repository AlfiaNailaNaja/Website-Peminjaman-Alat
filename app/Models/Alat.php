<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $table = 'alat';
    protected $fillable = [
        'kategori_id', 'kode_alat', 'nama', 'deskripsi', 
        'stok', 'stok_tersedia', 'kondisi', 'foto',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class, 'alat_id');
    }

    // TAMBAHKAN RELASI INI:
    public function peminjaman()
    {
        return $this->hasManyThrough(
            Peminjaman::class,
            DetailPeminjaman::class,
            'alat_id',         // Foreign key di tabel detail_peminjaman
            'id',              // Foreign key di tabel peminjaman
            'id',              // Local key di tabel alat
            'peminjaman_id'    // Local key di tabel detail_peminjaman
        );
    }
}