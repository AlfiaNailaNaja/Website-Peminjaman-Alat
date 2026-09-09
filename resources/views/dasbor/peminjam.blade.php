@extends('layouts.utama')

@section('judul', 'Dasbor Peminjam')

@section('konten')
<style>
    .stat-card {
        border: 1px solid #e2e8f0 !important;
        border-radius: 12px;
    }

    .border-accent-blue { border-left: 5px solid #2563eb !important; }
    .border-accent-amber { border-left: 5px solid #d97706 !important; }
    .border-accent-purple { border-left: 5px solid #7c3aed !important; }
    .border-accent-green { border-left: 5px solid #059669 !important; }

    .icon-box {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<div class="mb-4">
    <h4 class="fw-bold text-dark mb-1">Dasbor Peminjam</h4>
    <p class="text-muted small">Selamat datang kembali, <strong>{{ auth()->user()->nama }}</strong>.</p>
</div>

<!-- STAT CARDS (TANPA NAVIGASI) -->
<div class="row g-4 mb-4">
    <!-- Sedang Dipinjam -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="card stat-card border-accent-blue shadow-sm bg-white p-2">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-uppercase text-secondary fw-bold small tracking-wider" style="font-size: 0.75rem;">Sedang Dipinjam</span>
                        <h2 class="fw-bold mb-0 mt-1 text-dark">{{ $totalDipinjam ?? 0 }}</h2>
                    </div>
                    <div class="icon-box text-primary" style="background-color: #eff6ff;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                            <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.489L5.61 5.07l7.544 3.018 2.115-.846a.5.5 0 0 0 0-.928zM15 8.51l-5.5 2.2v5.52l5.5-2.2zm-6.5 7.72v-5.52L3 8.51v5.52zM15 7.387l-2.022.809L5.435 5.178l2.022-.809zM2.5 4.887l7.545 3.018-2.115.846L.386 5.733a.5.5 0 0 0 0 .928z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menunggu Persetujuan -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="card stat-card border-accent-amber shadow-sm bg-white p-2">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-uppercase text-secondary fw-bold small tracking-wider" style="font-size: 0.75rem;">Menunggu Persetujuan</span>
                        <h2 class="fw-bold mb-0 mt-1 text-dark">{{ $totalPending ?? 0 }}</h2>
                    </div>
                    <div class="icon-box text-warning" style="background-color: #fffbeb;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                            <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.122.34zm1.728.901a7 7 0 0 0-.722-.516l.447-.893c.313.157.611.332.894.524zm1.261 1.401a7 7 0 0 0-.416-.628l.673-.74c.247.225.48.468.697.728zM1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m7-5a.5.5 0 0 1 .5.5v4.293l2.854 2.853a.5.5 0 0 1-.708.708l-3-3A.5.5 0 0 1 7 7.5v-4A.5.5 0 0 1 7.5 3"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menunggu Verifikasi -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="card stat-card border-accent-purple shadow-sm bg-white p-2">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-uppercase text-secondary fw-bold small tracking-wider" style="font-size: 0.75rem;">Menunggu Verifikasi</span>
                        <h2 class="fw-bold mb-0 mt-1 text-dark">{{ $totalMenungguVerifikasi ?? 0 }}</h2>
                    </div>
                    <div class="icon-box" style="color: #7c3aed; background-color: #f3e8ff;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4.2-4.2a.5.5 0 0 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Selesai Dikembalikan -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="card stat-card border-accent-green shadow-sm bg-white p-2">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-uppercase text-secondary fw-bold small tracking-wider" style="font-size: 0.75rem;">Selesai Dikembalikan</span>
                        <h2 class="fw-bold mb-0 mt-1 text-dark">{{ $totalSelesai ?? 0 }}</h2>
                    </div>
                    <div class="icon-box text-success" style="background-color: #ecfdf5;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- CALL TO ACTION BANNER -->
<div class="card shadow-sm border-0 mb-4" style="border: 1px solid #e2e8f0 !important; border-radius: 12px; background-color: #ffffff;">
    <div class="card-body p-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h5 class="fw-bold text-dark mb-1">Layanan Pengajuan Peminjaman Alat</h5>
            <p class="text-muted small mb-0">Akses katalog alat untuk menemukan dan mengajukan peralatan kerja sesuai kebutuhan operasional Anda.</p>
        </div>
        <a href="{{ route('katalog.daftar') }}" class="btn btn-primary px-4 py-2 fw-semibold" style="border-radius: 8px;">
            Buka Katalog Alat
        </a>
    </div>
</div>
@endsection