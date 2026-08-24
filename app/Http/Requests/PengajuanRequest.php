<?php

namespace App\Http\Requests;

use App\Models\Pengaturan;
use Illuminate\Foundation\Http\FormRequest;

class PengajuanRequest extends FormRequest
{
    /**
     * Menentukan apakah pengguna diizinkan untuk membuat permintaan ini.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('peminjaman.ajukan') ?? false;
    }

    /**
     * Mendapatkan aturan validasi yang berlaku untuk permintaan ini.
     */
    public function rules(): array
    {
        $maksHari = (int) Pengaturan::ambil('maks_hari_pinjam', 30);
        $batasAkhir = now()->addDays($maksHari)->toDateString();

        return [
            'tgl_pinjam' => [
                'required', 
                'date', 
                'after_or_equal:today',
            ],
            'tgl_harus_kembali' => [
                'required', 
                'date', 
                'after_or_equal:tgl_pinjam', 
                'before_or_equal:' . $batasAkhir,
            ],
            'keperluan' => [
                'nullable', 
                'string', 
                'max:500',
            ],
        ];
    }
}