@extends('layouts.utama')

@section('judul', 'Dasbor Admin')

@section('konten')
<style>
    .stat-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: none;
        border-radius: 12px;
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
    }
    .border-accent-primary { border-left: 5px solid #0d6efd !important; }
    .border-accent-success { border-left: 5px solid #198754 !important; }
    .border-accent-info { border-left: 5px solid #0dcaf0 !important; }
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
    <h4 class="fw-bold mb-1">Dasbor Admin</h4>
    <p class="text-muted">Selamat datang, {{ auth()->user()->nama }}.</p>
</div>

<!-- 1. STAT CARDS (3 KOLOM) -->
<div class="row g-4 mb-4">
    <!-- Total Alat -->
    <div class="col-12 col-md-4">
        <div class="card stat-card border-accent-primary shadow-sm bg-white p-2">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-uppercase text-muted fw-bold small tracking-wide">Total Alat</span>
                    <h2 class="fw-bold mb-0 mt-1 text-dark">{{ $totalAlat }}</h2>
                </div>
                <div class="icon-box bg-primary bg-opacity-10 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                        <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.489L5.61 5.07l7.544 3.018 2.115-.846a.5.5 0 0 0 0-.928zM15 8.51l-5.5 2.2v5.52l5.5-2.2zm-6.5 7.72v-5.52L3 8.51v5.52zM15 7.387l-2.022.809L5.435 5.178l2.022-.809zM2.5 4.887l7.545 3.018-2.115.846L.386 5.733a.5.5 0 0 0 0 .928z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Kategori -->
    <div class="col-12 col-md-4">
        <div class="card stat-card border-accent-success shadow-sm bg-white p-2">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-uppercase text-muted fw-bold small tracking-wide">Total Kategori</span>
                    <h2 class="fw-bold mb-0 mt-1 text-dark">{{ $totalKategori }}</h2>
                </div>
                <div class="icon-box bg-success bg-opacity-10 text-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-tags" viewBox="0 0 16 16">
                        <path d="M3 2e1a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 3 6.586zm4 5a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                        <path d="M2 7a1 1 0 0 1 1-1h.01a1 1 0 0 1 1 1v.01a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1zm0 3a1 1 0 0 1 1-1h.01a1 1 0 0 1 1 1v.01a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pengguna -->
    <div class="col-12 col-md-4">
        <div class="card stat-card border-accent-info shadow-sm bg-white p-2">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-uppercase text-muted fw-bold small tracking-wide">Total Pengguna</span>
                    <h2 class="fw-bold mb-0 mt-1 text-dark">{{ $totalPengguna }}</h2>
                </div>
                <div class="icon-box bg-info bg-opacity-10 text-info">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.72C2.312 10.629 3.282 10 5 10c.002 0 .004 0 .006 0M3.5 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m-1-2a3 3 0 1 1 6 0 3 3 0 0 1-6 0"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 2. GRAFIK METRIKS -->
<div class="row">
    <div class="col-12 col-lg-8 mb-4">
        <div class="card border-0 shadow-sm style-card" style="border-radius: 12px;">
            <div class="card-header bg-white fw-bold py-3 border-0">
                Jumlah Alat per Kategori
            </div>
            <div class="card-body">
                <canvas id="kategoriChart" height="130"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('kategoriChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Jumlah Alat',
                data: {!! json_encode($chartData) !!},
                backgroundColor: 'rgba(13, 110, 253, 0.85)',
                borderColor: 'rgba(13, 110, 253, 1)',
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });
</script>
@endsection