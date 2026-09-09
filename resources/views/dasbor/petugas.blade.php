@extends('layouts.utama')

@section('judul', 'Dasbor Petugas')

@section('konten')
<style>
    .stat-card {
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid #e2e8f0 !important;
        border-radius: 12px;
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px -10px rgba(15, 23, 42, 0.12) !important;
    }
    .border-accent-amber { border-left: 5px solid #d97706 !important; }
    .border-accent-blue { border-left: 5px solid #2563eb !important; }
    .border-accent-purple { border-left: 5px solid #7c3aed !important; }

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
    <h4 class="fw-bold text-dark mb-1">Dasbor Petugas</h4>
    <p class="text-muted small">Selamat datang kembali, <strong>{{ auth()->user()->nama }}</strong>.
</div>

<!-- 1. STAT CARDS -->
<div class="row g-4 mb-4">
    <!-- Antrean Persetujuan -->
    <div class="col-12 col-md-4">
        <div class="card stat-card border-accent-amber shadow-sm bg-white p-2">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-uppercase text-secondary fw-bold small tracking-wider" style="font-size: 0.75rem;">Antrean Persetujuan</span>
                    <h2 class="fw-bold mb-0 mt-1 text-dark">{{ $totalAntrean ?? 0 }}</h2>
                </div>
                <div class="icon-box" style="background-color: #fef3c7; color: #d97706;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-file-earmark-check" viewBox="0 0 16 16">
                        <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"/>
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Sedang Dipinjam -->
    <div class="col-12 col-md-4">
        <div class="card stat-card border-accent-blue shadow-sm bg-white p-2">
            <div class="card-body d-flex align-items-center justify-content-between">
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

    <!-- Verifikasi Pengembalian -->
    <div class="col-12 col-md-4">
        <div class="card stat-card border-accent-purple shadow-sm bg-white p-2">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-uppercase text-secondary fw-bold small tracking-wider" style="font-size: 0.75rem;">Verifikasi Pengembalian</span>
                    <h2 class="fw-bold mb-0 mt-1 text-dark">{{ $totalPengembalian ?? 0 }}</h2>
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

<!-- 2. KARTU AKSES CEPAT -->
<div class="row g-4 mb-4">
    <div class="col-12 col-md-6">
        <div class="card border-0 shadow-sm p-3" style="border-radius: 12px; border: 1px solid #e2e8f0 !important;">
            <div class="card-body">
                <h5 class="fw-bold text-dark">Antrean Persetujuan</h5>
                <p class="text-muted small">Tinjau dan proses pengajuan peminjaman alat yang masuk dari pengguna.</p>
                <a href="{{ route('persetujuan.antrian') }}" class="btn btn-warning text-dark w-100 fw-bold py-2 mt-2" style="border-radius: 8px; background-color: #ffc107;">
                    Buka Antrean Persetujuan
                </a>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="card border-0 shadow-sm p-3" style="border-radius: 12px; border: 1px solid #e2e8f0 !important;">
            <div class="card-body">
                <h5 class="fw-bold text-dark">Pantau & Verifikasi Pengembalian</h5>
                <p class="text-muted small">Verifikasi alat yang dikembalikan oleh pengguna dan periksa kondisinya.</p>
                <a href="{{ route('pengembalian.pantau') }}" class="btn btn-primary w-100 fw-bold py-2 mt-2" style="border-radius: 8px;">
                    Pantau Pengembalian
                </a>
            </div>
        </div>
    </div>
</div>

<!-- 3. BANNER LAPORAN (OPERASIONAL) -->
<div class="card shadow-sm border-0" style="border: 1px solid #e2e8f0 !important; border-radius: 12px;">
    <div class="card-body p-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h5 class="fw-bold text-dark mb-1">Perlu Ringkasan Laporan Peminjaman?</h5>
            <p class="text-muted small mb-0">Cetak dan rekap transaksi peminjaman serta stok alat laboratorium.</p>
        </div>
        <a href="{{ route('laporan.form') }}" class="btn btn-outline-primary px-4 py-2 fw-semibold" style="border-radius: 8px;">
            Cetak Laporan
        </a>
    </div>
</div>
@endsection