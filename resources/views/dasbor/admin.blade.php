@extends('layouts.utama')

@section('judul', 'Dasbor Admin')

@section('konten')
    <style>
        .stat-card {
            border: none;
            border-radius: 14px;
            height: 100%;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
        }

        .border-accent-primary { border-left: 5px solid #0d6efd !important; }
        .border-accent-success { border-left: 5px solid #198754 !important; }
        .border-accent-info    { border-left: 5px solid #0dcaf0 !important; }
        .border-accent-teal    { border-left: 5px solid #20c997 !important; }

        .icon-box {
            width: 46px;
            height: 46px;
            min-width: 46px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .icon-primary { background: #0d6efd; color: #fff; }
        .icon-success { background: #198754; color: #fff; }
        .icon-info    { background: #0dcaf0; color: #fff; }
        .icon-teal    { background: #20c997; color: #fff; }

        .stat-title {
            font-size: 0.75rem;
            font-weight: 700;
            color: #6c757d;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .chart-card {
            border-radius: 14px;
            border: none;
        }
    </style>

    <!-- HEADER & FILTER -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Dasbor Admin</h4>
            <p class="text-muted mb-0">Selamat datang, {{ auth()->user()->nama ?? 'Administrator' }}.</p>
        </div>

        <!-- Form Filter Bulan & Tahun -->
        <form method="GET" action="{{ route('admin.dasbor') }}" class="d-flex gap-2 mt-3 mt-md-0">
            <select name="bulan" class="form-select form-select-sm shadow-sm" style="width: 140px;">
                @foreach (range(1, 12) as $b)
                    <option value="{{ $b }}" {{ $bulanFilter == $b ? 'selected' : '' }}>
                        {{ date('F', mktime(0, 0, 0, $b, 10)) }}
                    </option>
                @endforeach
            </select>

            <select name="tahun" class="form-select form-select-sm shadow-sm" style="width: 100px;">
                @foreach (range(date('Y') - 2, date('Y')) as $t)
                    <option value="{{ $t }}" {{ $tahunFilter == $t ? 'selected' : '' }}>
                        {{ $t }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-sm btn-primary shadow-sm px-3">Filter</button>
        </form>
    </div>

    <!-- 1. STAT CARDS BARIS 1 -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card stat-card border-accent-primary shadow-sm bg-white">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div class="me-2">
                        <div class="stat-title text-uppercase">TOTAL ALAT</div>
                        <h3 class="fw-bold mb-0 mt-1 text-dark">{{ $totalAlat }}</h3>
                    </div>
                    <div class="icon-box icon-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-hdd-stack" viewBox="0 0 16 16">
                            <path d="M2.5 6a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zm0-1h11A1.5 1.5 0 0 1 15 6.5v3a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 9.5v-3A1.5 1.5 0 0 1 2.5 5z"/>
                            <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0m6.5 1a.5.5 0 0 0 .5-.5.5.5 0 0 0-.5-.5h-4a.5.5 0 0 0 0 1zm0-2A1.5 1.5 0 0 1 13 8.5 1.5 1.5 0 0 1 11.5 10h-4A1.5 1.5 0 0 1 6 8.5 1.5 1.5 0 0 1 7.5 7zM2.5 11a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zm0-1h11a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5v-3A1.5 1.5 0 0 1 2.5 10"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="card stat-card border-accent-success shadow-sm bg-white">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div class="me-2">
                        <div class="stat-title text-uppercase">KATEGORI</div>
                        <h3 class="fw-bold mb-0 mt-1 text-dark">{{ $totalKategori }}</h3>
                    </div>
                    <div class="icon-box icon-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bookmark-star" viewBox="0 0 16 16">
                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="card stat-card border-accent-info shadow-sm bg-white">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div class="me-2">
                        <div class="stat-title text-uppercase">TOTAL USER</div>
                        <h3 class="fw-bold mb-0 mt-1 text-dark">{{ $totalPengguna }}</h3>
                    </div>
                    <div class="icon-box icon-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                            <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.72C2.312 10.629 3.282 10 5 10zM3.5 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m0-1a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="card stat-card border-accent-teal shadow-sm bg-white">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div class="me-2">
                        <div class="stat-title text-uppercase">SELESAI (BULAN INI)</div>
                        <h3 class="fw-bold mb-0 mt-1 text-dark">{{ $totalSelesaiBulanIni }}</h3>
                        <small class="text-muted" style="font-size: 0.7rem;">Total All-Time: {{ $totalSelesaiAllTime }}</small>
                    </div>
                    <div class="icon-box icon-teal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-seam-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15.528 3.673a1 1 0 0 1 .472.827v6.999a1 1 0 0 1-.516.868l-7 3.998a1 1 0 0 1-.968 0l-7-3.998A1 1 0 0 1 0 11.499V4.5a1 1 0 0 1 .472-.827l7-4a1 1 0 0 1 1.056 0l7 4zm-5.2 3.123 3.879-1.939-2.063-1.179-3.834 1.917zM7.5 14.214l6-3.429V7.518l-6 3zm-1 0v-6.696l-6-3v3.267l6 3.429z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. GRAFIK TREN HARIAN -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card chart-card shadow-sm bg-white">
                <div class="card-header bg-white fw-bold py-3 border-0">
                    Grafik Transaksi Selesai Harian ({{ date('F Y', mktime(0, 0, 0, $bulanFilter, 10, $tahunFilter)) }})
                </div>
                <div class="card-body">
                    <canvas id="trenSelesaiChart" height="90"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. GRAFIK KATEGORI PENGEMBALIAN & TOP ALAT -->
    <div class="row">
        <!-- Status Pengembalian Selesai -->
        <div class="col-12 col-lg-6 mb-4 mb-lg-0">
            <div class="card chart-card shadow-sm bg-white h-100">
                <div class="card-header bg-white fw-bold py-3 border-0">
                    Kategori Pengembalian Selesai
                </div>
                <div class="card-body">
                    <canvas id="kategoriPengembalianChart" height="150"></canvas>
                </div>
            </div>
        </div>

        <!-- Top 5 Alat -->
        <div class="col-12 col-lg-6">
            <div class="card chart-card shadow-sm bg-white h-100">
                <div class="card-header bg-white fw-bold py-3 border-0">
                    Top 5 Alat Paling Sering Selesai Dipinjam
                </div>
                <div class="card-body">
                    <canvas id="topAlatChart" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Chart.js -->
    <script src="{{ asset('js/chart.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // 1. Chart Tren Transaksi Selesai Harian
            const ctxTren = document.getElementById('trenSelesaiChart').getContext('2d');
            new Chart(ctxTren, {
                type: 'line',
                data: {
                    labels: {!! json_encode($tanggalLabels) !!},
                    datasets: [{
                        label: 'Peminjaman Selesai',
                        data: {!! json_encode($selesaiPerHari) !!},
                        borderColor: '#20c997',
                        backgroundColor: 'rgba(32, 201, 151, 0.15)',
                        fill: true,
                        tension: 0.3,
                        borderWidth: 2.5,
                        pointBackgroundColor: '#20c997',
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, ticks: { precision: 0 } },
                        x: { grid: { display: false } }
                    }
                }
            });

            // 2. Chart Kategori Pengembalian
            const ctxKatPengembalian = document.getElementById('kategoriPengembalianChart').getContext('2d');
            new Chart(ctxKatPengembalian, {
                type: 'bar',
                data: {
                    labels: {!! json_encode(array_keys($kategoriPengembalian)) !!},
                    datasets: [{
                        label: 'Jumlah Transaksi',
                        data: {!! json_encode(array_values($kategoriPengembalian)) !!},
                        backgroundColor: ['#198754', '#ffc107', '#dc3545'],
                        borderRadius: 8,
                        maxBarThickness: 50
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, ticks: { precision: 0 } },
                        x: { grid: { display: false } }
                    }
                }
            });

            // 3. Chart Top 5 Alat
            const ctxTopAlat = document.getElementById('topAlatChart').getContext('2d');
            new Chart(ctxTopAlat, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($topAlatLabels) !!},
                    datasets: [{
                        label: 'Frekuensi Selesai',
                        data: {!! json_encode($topAlatData) !!},
                        backgroundColor: '#0d6efd',
                        borderRadius: 6,
                        maxBarThickness: 25
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { beginAtZero: true, ticks: { precision: 0 } },
                        y: { grid: { display: false } }
                    }
                }
            });

        });
    </script>
@endsection