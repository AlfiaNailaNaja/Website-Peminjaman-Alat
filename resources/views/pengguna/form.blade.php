@extends('layouts.utama')

@section('judul', $pengguna->exists ? 'Ubah Pengguna' : 'Tambah Pengguna')

@section('konten')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">
                    {{ $pengguna->exists ? 'Ubah Data Pengguna' : 'Tambah Data Pengguna' }}
                </h5>

                <form method="POST" action="{{ $pengguna->exists ? route('pengguna.update', $pengguna) : route('pengguna.store') }}">
                    @csrf
                    @if ($pengguna->exists)
                        @method('PUT')
                    @endif

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <x-input label="Nama Lengkap" name="nama" :value="$pengguna->nama" required />
                            <div class="form-text text-muted">
                                Masukkan nama lengkap (wajib diisi).
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <x-input label="Nama Pengguna" name="username" :value="$pengguna->username" required />
                            <div class="form-text text-muted">
                                Gunakan kombinasi huruf/angka (wajib diisi).
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <x-input label="Email" name="email" :value="$pengguna->email" type="email" />
                            <div class="form-text text-muted">
                                Alamat email aktif (opsional).
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <x-input label="Nomor Telepon" name="no_telp" :value="$pengguna->no_telp" />
                            <div class="form-text text-muted">
                                Nomor HP yang aktif (opsional).
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <x-input 
                                label="Kata Sandi" 
                                name="password" 
                                type="password" 
                                :required="!$pengguna->exists" 
                            />
                            <div class="form-text text-muted">
                                {{ $pengguna->exists ? 'Dikosongkan bila tidak ingin diganti (minimal 8 karakter jika diisi).' : 'Kata sandi minimal terdiri dari 8 karakter.' }}
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <x-input 
                                label="Konfirmasi Kata Sandi" 
                                name="password_confirmation" 
                                type="password" 
                                :required="!$pengguna->exists" 
                            />
                            <div class="form-text text-muted">
                                Masukkan ulang kata sandi yang sama persis.
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="peran" class="form-label">Peran <span class="text-danger">*</span></label>
                            <select class="form-select @error('peran') is-invalid @enderror" id="peran" name="peran" required>
                                <option value="">-- Pilih Peran --</option>
                                @foreach ($daftarPeran as $pilihanPeran)
                                    <option value="{{ $pilihanPeran->name }}" {{ old('peran', $pengguna->roles->first()?->name) == $pilihanPeran->name ? 'selected' : '' }}>
                                        {{ ucfirst($pilihanPeran->name) }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text text-muted">
                                Pilih hak akses/peran pengguna pada sistem.
                            </div>
                            @error('peran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <x-select 
                                label="Status Aktif" 
                                name="is_aktif" 
                                :value="$pengguna->is_aktif ?? 1" 
                                placeholder="Pilih status aktif"
                                :opsi="[
                                    ['key' => 1, 'label' => 'Aktif'],
                                    ['key' => 0, 'label' => 'Nonaktif']
                                ]" 
                                required
                            />
                            <div class="form-text text-muted">
                                Bawaan akun baru otomatis diset <strong>Aktif</strong>.
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection