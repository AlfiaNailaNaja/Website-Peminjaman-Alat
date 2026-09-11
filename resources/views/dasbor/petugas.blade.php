@extends('layouts.utama')

@section('judul', 'Dasbor Petugas')

@section('konten')
<style>
    /* Stat Cards Interaktif */
    .stat-card {
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid #e2e8f0 !important;
        border-radius: 12px;
        text-decoration: none !important;
        display: block;
    }
    a.stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px -10px rgba(15, 23, 42, 0.12) !important;
    }
    
    .stat-card-disabled {
        opacity: 0.75;
        cursor: not-allowed;
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
        box-shadow: 0 6px 14px -4px var(--icon-shadow);
        transition: transform 0.2s ease;
    }

    .stat-card:hover .icon-box {
        transform: scale(1.08) rotate(-3deg);
    }

    .icon-blue {
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        --icon-shadow: rgba(37, 99, 235, 0.4);
        color: #fff;
    }

    .icon-amber {
        background: linear-gradient(135deg, #d97706, #f59e0b);
        --icon-shadow: rgba(217, 119, 6, 0.4);
        color: #fff;
    }

    .icon-purple {
        background: linear-gradient(135deg, #7c3aed, #a78bfa);
        --icon-shadow: rgba(124, 58, 237, 0.4);
        color: #fff;
    }
</style>

<div class="mb-4">
    <h4 class="fw-bold text-dark mb-1">Dasbor Petugas</h4>
    <p class="text-muted small">Selamat datang kembali, <strong>{{ auth()->user()->nama }}</strong>.</p>
</div>

<!-- KARTU STATISTIK -->
<div class="row g-4 mb-4">
    <!-- Antrean Persetujuan -->
    <div class="col-12 col-md-4">
        <a href="{{ route('persetujuan.antrian') }}" class="card stat-card border-accent-amber shadow-sm bg-white p-2">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div>
                        <span class="text-uppercase text-secondary fw-bold small tracking-wider" style="font-size: 0.75rem;">Antrean Persetujuan</span>
                        <h2 class="fw-bold mb-0 mt-1 text-dark">{{ $totalAntrean ?? 0 }}</h2>
                    </div>
                    <div class="icon-box icon-amber">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-file-earmark-check" viewBox="0 0 16 16">
                            <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"/>
                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                        </svg>
                    </div>
                </div>
                <div class="pt-2 border-top d-flex align-items-center justify-content-between text-muted" style="font-size: 0.8rem;">
                    <span>Tinjau pengajuan baru</span>
                    <span class="fw-bold text-dark">&rarr;</span>
                </div>
            </div>
        </a>
    </div>

    <!-- Sedang Dipinjam  -->
    <div class="col-12 col-md-4">
        @if(($totalDipinjam ?? 0) > 0)
            <a href="{{ route('pengembalian.pantau') }}" class="card stat-card border-accent-blue shadow-sm bg-white p-2">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div>
                            <span class="text-uppercase text-secondary fw-bold small tracking-wider" style="font-size: 0.75rem;">Sedang Dipinjam</span>
                            <h2 class="fw-bold mb-0 mt-1 text-dark">{{ $totalDipinjam }}</h2>
                        </div>
                        <div class="icon-box icon-blue">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.489L5.61 5.07l7.544 3.018 2.115-.846a.5.5 0 0 0 0-.928zM15 8.51l-5.5 2.2v5.52l5.5-2.2zm-6.5 7.72v-5.52L3 8.51v5.52zM15 7.387l-2.022.809L5.435 5.178l2.022-.809zM2.5 4.887l7.545 3.018-2.115.846L.386 5.733a.5.5 0 0 0 0 .928z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="pt-2 border-top d-flex align-items-center justify-content-between text-muted" style="font-size: 0.8rem;">
                        <span>Pantau peminjaman aktif</span>
                        <span class="fw-bold text-dark">&rarr;</span>
                    </div>
                </div>
            </a>
        @else
            <div class="card stat-card stat-card-disabled border-accent-blue shadow-sm bg-white p-2">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div>
                            <span class="text-uppercase text-secondary fw-bold small tracking-wider" style="font-size: 0.75rem;">Sedang Dipinjam</span>
                            <h2 class="fw-bold mb-0 mt-1 text-dark">0</h2>
                        </div>
                        <div class="icon-box icon-blue">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.489L5.61 5.07l7.544 3.018 2.115-.846a.5.5 0 0 0 0-.928zM15 8.51l-5.5 2.2v5.52l5.5-2.2zm-6.5 7.72v-5.52L3 8.51v5.52zM15 7.387l-2.022.809L5.435 5.178l2.022-.809zM2.5 4.887l7.545 3.018-2.115.846L.386 5.733a.5.5 0 0 0 0 .928z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="pt-2 border-top d-flex align-items-center justify-content-between text-muted" style="font-size: 0.8rem;">
                        <span>Tidak ada barang dipinjam</span>
                        <span>&bull;</span>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Verifikasi Pengembalian -->
    <div class="col-12 col-md-4">
        <a href="{{ route('pengembalian.antrian') }}" class="card stat-card border-accent-purple shadow-sm bg-white p-2">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div>
                        <span class="text-uppercase text-secondary fw-bold small tracking-wider" style="font-size: 0.75rem;">Verifikasi Pengembalian</span>
                        <h2 class="fw-bold mb-0 mt-1 text-dark">{{ $totalPengembalian ?? 0 }}</h2>
                    </div>
                    <div class="icon-box icon-purple">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4.2-4.2a.5.5 0 0 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"/>
                        </svg>
                    </div>
                </div>
                <div class="pt-2 border-top d-flex align-items-center justify-content-between text-muted" style="font-size: 0.8rem;">
                    <span>Proses verifikasi pengembalian</span>
                    <span class="fw-bold text-dark">&rarr;</span>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- LAPORAN -->
<div class="card shadow-sm border-0 mb-4" style="border: 1px solid #e2e8f0 !important; border-radius: 12px; background-color: #f8fafc;">
    <div class="card-body p-3 px-4 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="text-secondary d-none d-sm-block">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                    <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                    <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zM1 7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1zm3 4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1z"/>
                </svg>
            </div>
            <div>
                <h6 class="fw-bold text-dark mb-0">Laporan & Rekapitulasi Peminjaman</h6>
                <p class="text-muted small mb-0">Cetak rekap data transaksi peminjaman dan riwayat alat laboratorium.</p>
            </div>
        </div>
        <a href="{{ route('laporan.form') }}" class="btn btn-light border btn-sm px-3 fw-medium text-nowrap align-self-start align-self-sm-center" style="border-radius: 6px; background-color: #ffffff;">
            Cetak Laporan
        </a>
    </div>
</div>
@endsection