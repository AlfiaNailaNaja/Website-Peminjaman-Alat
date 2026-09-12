@extends('layouts.utama')

@section('judul', 'Daftar Pengguna')

@section('konten')

{{-- SEKSI 1: DAFTAR PENGGUNA TERVERIFIKASI (UTAMA) --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Daftar Pengguna</h4>
    <x-tombol-tambah href="{{ route('pengguna.create') }}" label="Tambah Pengguna" />
</div>

<div class="card mb-4">
    <div class="card-body">

        @include('pengguna.form-pencarian')

        @include('pengguna.table')

        {{ $daftarPengguna->links() }}

    </div>
</div>

{{-- SEKSI 2: TABEL PENDAFTARAN MENUNGGU PERSETUJUAN (PALING BAWAH) --}}
@if (isset($pendaftaranPending) && $pendaftaranPending->count() > 0)
    <div class="card border-warning shadow-sm mt-4">
        <div class="card-header bg-warning text-dark fw-bold py-2 d-flex justify-content-between align-items-center">
            <span>
                <i class="bi bi-clock-history me-2"></i>Permintaan Persetujuan Pendaftaran Peminjam ({{ $pendaftaranPending->count() }})
            </span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px" class="ps-3">No</th>
                            <th>Nama</th>
                            <th>Nama Pengguna</th>
                            <th>Telepon</th>
                            <th>Waktu Daftar</th>
                            <th style="width: 180px" class="text-start pe-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendaftaranPending as $nomor => $pending)
                            <tr>
                                <td class="ps-3">{{ $nomor + 1 }}</td>
                                <td class="fw-bold">{{ $pending->nama }}</td>
                                <td><code>{{ $pending->username }}</code></td>
                                <td>{{ $pending->no_telp ?: '-' }}</td>
                                <td><small class="text-muted">{{ $pending->created_at ? $pending->created_at->diffForHumans() : '-' }}</small></td>
                                <td class="pe-3">
                                    <div class="d-flex align-items-center justify-content-start gap-1">
                                        {{-- Tombol Setujui --}}
                                        <form action="{{ route('pengguna.setujui', $pending) }}" method="POST" class="d-inline" onsubmit="return confirm('Setujui pendaftaran {{ $pending->nama }}?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-success fw-bold text-nowrap">
                                                <i class="bi bi-check-circle me-1"></i>Setujui
                                            </button>
                                        </form>

                                        {{-- Tombol Tolak / Hapus Pendaftaran Pending --}}
                                        <form action="{{ route('pengguna.destroy', $pending) }}" method="POST" class="d-inline" onsubmit="return confirm('Tolak dan hapus pendaftaran {{ $pending->nama }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Tolak Pendaftaran">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif

@endsection