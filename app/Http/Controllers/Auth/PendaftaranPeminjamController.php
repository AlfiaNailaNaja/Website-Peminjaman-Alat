<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class PendaftaranPeminjamController extends Controller
{
    /**
     * Menampilkan form pendaftaran peminjam
     */
    public function create()
    {
        return view('auth.daftar-peminjam');
    }

    /**
     * Memproses pendaftaran peminjam baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'     => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email'    => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'no_telp'  => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $pengguna = User::create([
            'nama'         => $request->nama,
            'username'     => $request->username,
            'email'        => $request->email,
            'no_telp'      => $request->no_telp,
            'password'     => Hash::make($request->password),
            'is_aktif'     => false,
            'is_disetujui' => false, // Default false: Butuh persetujuan Admin untuk login
        ]);

        // Berikan role 'peminjam' (Spatie)
        $pengguna->assignRole('peminjam');

        return redirect()->route('login')->with('sukses', 'Pendaftaran berhasil! Akun Anda sedang menunggu persetujuan Admin sebelum dapat digunakan untuk login.');
    }
}