<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenggunaRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class PenggunaController extends Controller
{
    public function index(Request $request)
    {
        $kataKunci = $request->query('cari');
        $peran     = $request->query('peran');

        // 1. Ambil pendaftar baru yang BELUM DISETUJUI
        $pendaftaranPending = User::with('roles')
            ->where('is_disetujui', false)
            ->orderBy('created_at', 'desc')
            ->get();

        // 2. Ambil pengguna yang SUDAH DISETUJUI untuk tabel utama
        $daftarPengguna = User::with('roles')
            ->where('is_disetujui', true)
            ->when($kataKunci, function ($query, $kataKunci) {
                $query->where(function ($cabang) use ($kataKunci) {
                    $cabang->where('nama', 'like', '%' . $kataKunci . '%')
                        ->orWhere('username', 'like', '%' . $kataKunci . '%');
                });
            })
            ->when($peran, function ($query, $peran) {
                $query->role($peran);
            })
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        $daftarPeran = Role::orderBy('name')->get();

        return view('pengguna.index', compact(
            'daftarPengguna',
            'pendaftaranPending',
            'daftarPeran',
            'kataKunci',
            'peran'
        ));
    }

    public function create()
    {
        $pengguna = new User();
        $daftarPeran = Role::orderBy('name')->get();

        return view('pengguna.form', compact('pengguna', 'daftarPeran'));
    }

    public function store(PenggunaRequest $request)
    {
        $data = $request->validated();

        $pengguna = User::create([
            'nama'         => $data['nama'],
            'username'     => $data['username'],
            'email'        => $data['email'] ?? null,
            'no_telp'      => $data['no_telp'] ?? null,
            'password'     => $data['password'],
            'is_aktif'     => $data['is_aktif'],
            'is_disetujui' => true, // Pengguna yang dibuat langsung oleh Admin otomatis disetujui
        ]);

        $pengguna->syncRoles([$data['peran']]);

        return redirect()
            ->route('pengguna.index')
            ->with('sukses', 'Pengguna berhasil ditambahkan.');
    }

    public function setujui(User $pengguna)
    {
        $pengguna->update([
            'is_disetujui' => true,
            'is_aktif'     => true
        ]);

        return redirect()
            ->route('pengguna.index')
            ->with('sukses', 'Akun peminjam ' . $pengguna->nama . ' berhasil disetujui dan diaktifkan.');
    }

    public function edit(User $pengguna)
    {
        $daftarPeran = Role::orderBy('name')->get();

        return view('pengguna.form', compact('pengguna', 'daftarPeran'));
    }

    public function update(PenggunaRequest $request, User $pengguna)
    {
        $data = $request->validated();

        if ($this->diriSendiri($pengguna) && ! $data['is_aktif']) {
            return back()
                ->with('gagal', 'Anda tidak dapat menonaktifkan akun Anda sendiri.')
                ->withInput();
        }

        $pengguna->nama     = $data['nama'];
        $pengguna->username = $data['username'];
        $pengguna->email    = $data['email'] ?? null;
        $pengguna->no_telp  = $data['no_telp'] ?? null;
        $pengguna->is_aktif = $data['is_aktif'];

        if (! empty($data['password'])) {
            $pengguna->password = $data['password'];
        }

        $pengguna->save();
        $pengguna->syncRoles([$data['peran']]);

        return redirect()
            ->route('pengguna.index')
            ->with('sukses', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy(User $pengguna)
    {
        if ($this->diriSendiri($pengguna)) {
            return redirect()
                ->route('pengguna.index')
                ->with('gagal', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        if ($pengguna->peminjamanDiajukan()->exists()) {
            return redirect()
                ->route('pengguna.index')
                ->with('gagal', 'Pengguna tidak dapat dihapus karena memiliki riwayat peminjaman. Nonaktifkan akunnya sebagai gantinya.');
        }

        $pesan = $pengguna->is_disetujui 
            ? 'Pengguna berhasil dihapus.' 
            : 'Pendaftaran pengguna berhasil ditolak dan dihapus.';

        $pengguna->delete();

        return redirect()
            ->route('pengguna.index')
            ->with('sukses', $pesan);
    }

    private function diriSendiri(User $pengguna): bool
    {
        return $pengguna->id === Auth::id();
    }
}