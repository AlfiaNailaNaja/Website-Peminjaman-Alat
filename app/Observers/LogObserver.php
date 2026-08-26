<?php

namespace App\Observers;

use App\Models\LogAktivitas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth; // 1. Tambahkan Facade Auth

class LogObserver
{
    public function created(Model $model): void
    {
        $this->catat($model, 'create', 'Menambah data');
    }

    public function updated(Model $model): void
    {
        $this->catat($model, 'update', 'Mengubah data');
    }

    public function deleted(Model $model): void
    {
        $this->catat($model, 'delete', 'Menghapus data');
    }

    private function catat(Model $model, string $aksi, string $awalanPesan): void
    {
        // 2. Gunakan Auth::check()
        if (! Auth::check()) {
            return;
        }

        LogAktivitas::create([
            // 3. Gunakan Auth::id()
            'user_id'      => Auth::id(),
            'aksi'         => $aksi,
            'tabel_tujuan' => $model->getTable(),
            'deskripsi'    => $awalanPesan . ' ' . $model->getTable() . ': ' . $this->namaData($model) . ' (ID ' . $model->getKey() . ')',
            'ip_address'   => request()->ip(),
        ]);
    }

    private function namaData(Model $model): string
    {
        return $model->nama
            ?? $model->kode_alat
            ?? $model->username
            ?? '-';
    }
}