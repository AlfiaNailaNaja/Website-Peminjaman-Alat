@extends('layouts.utama')

@section('judul', 'Katalog Alat')

@section('konten')
<h4 class="mb-3">Katalog Alat</h4>

@include('katalog.form-pencarian')

<div class="row g-3">
    @forelse ($daftarAlat as $alat)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                {{-- Foto Alat --}}
                @if ($alat->foto)
                    <img src="{{ asset('gambar/alat/' . $alat->foto) }}" 
                         class="card-img-top" 
                         style="height: 160px; object-fit: cover;" 
                         alt="{{ $alat->nama }}">
                @else
                    <div class="bg-secondary-subtle d-flex align-items-center justify-content-center" style="height: 160px;">
                        <span class="text-muted small">Tanpa foto</span>
                    </div>
                @endif

                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <h6 class="card-title mb-0">{{ $alat->nama }}</h6>
                            <span class="badge bg-{{ $alat->stok_tersedia > 0 ? 'success' : 'secondary' }}">
                                {{ $alat->stok_tersedia }} tersedia
                            </span>
                        </div>

                        <p class="text-muted small mb-3">
                            {{ $alat->kode_alat }} &middot; {{ $alat->kategori->nama }}
                        </p>
                    </div>

                    {{-- Form Tambah ke Keranjang / Stok Habis --}}
                    <div>
                        @if ($alat->stok_tersedia > 0)
                            <form method="POST" action="{{ route('katalog.tambah', $alat) }}" class="row g-2">
                                @csrf
                                <div class="col-4">
                                    <input type="number" 
                                           name="jumlah" 
                                           class="form-control form-control-sm" 
                                           value="1" 
                                           min="1" 
                                           max="{{ $alat->stok_tersedia }}" 
                                           required>
                                </div>
                                <div class="col-8">
                                    <button type="submit" class="btn btn-sm btn-primary w-100">
                                        Tambah ke Keranjang
                                    </button>
                                </div>
                            </form>
                        @else
                            <button class="btn btn-sm btn-secondary w-100" disabled>
                                Stok Habis
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info mb-0">
                Alat tidak ditemukan.
            </div>
        </div>
    @endforelse
</div>

{{-- Pagination Links --}}
<div class="mt-4">
    {{ $daftarAlat->links() }}
</div>
@endsection