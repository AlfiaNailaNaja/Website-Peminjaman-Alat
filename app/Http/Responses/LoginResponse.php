<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as KontrakLoginResponse;

class LoginResponse implements KontrakLoginResponse
{
    public function toResponse($request)
    {
        $pengguna = $request->user();

        // 1. Cek jika role peminjam DAN belum disetujui Admin (Pendaftaran Baru)
        if ($pengguna->hasRole('peminjam') && ! $pengguna->is_disetujui) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->withErrors([
                'username' => 'Akun Anda sedang menunggu persetujuan dari Admin.',
            ]);
        }

        // 2. Cek jika akun berstatus NONAKTIF (Berlaku untuk semua pengguna yang dinonaktifkan Admin)
        if (! $pengguna->is_aktif) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->withErrors([
                'username' => 'Akun Anda dinonaktifkan. Silakan hubungi admin.',
            ]);
        }

        // 3. Pengalihan halaman berdasarkan Role setelah berhasil login & aktif
        if ($pengguna->hasRole('admin')) {
            return redirect()->route('admin.dasbor');
        }

        if ($pengguna->hasRole('petugas')) {
            return redirect()->route('petugas.dasbor');
        }

        return redirect()->route('peminjam.dasbor');
    }
}