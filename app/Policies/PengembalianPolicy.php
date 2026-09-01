<?php

namespace App\Policies;

use App\Models\Pengembalian;
use App\Models\User;

class PengembalianPolicy
{
    /**
     * Menentukan apakah pengguna dapat memperbarui data pengembalian.
     */
    public function update(User $pengguna, Pengembalian $pengembalian): bool
    {
        return $pengguna->can('pengembalian.kelola');
    }

    /**
     * Menentukan apakah pengguna dapat menghapus data pengembalian.
     */
    public function delete(User $pengguna, Pengembalian $pengembalian): bool
    {
        return false;
    }
}