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

        .border-accent-primary {
            border-left: 5px solid #0d6efd !important;
        }

        .border-accent-success {
            border-left: 5px solid #198754 !important;
        }

        .border-accent-info {
            border-left: 5px solid #0dcaf0 !important;
        }

        .icon-box {
            width: 54px;
            height: 54px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 14px -4px var(--icon-shadow);
            transition: transform 0.2s ease;
        }

        .stat-card:hover .icon-box {
            transform: scale(1.08) rotate(-3deg);
        }

        .icon-primary {
            background: linear-gradient(135deg, #0d6efd, #3b82f6);
            --icon-shadow: rgba(13, 110, 253, 0.4);
            color: #fff;
        }

        .icon-success {
            background: linear-gradient(135deg, #198754, #22c55e);
            --icon-shadow: rgba(25, 135, 84, 0.4);
            color: #fff;
        }

        .icon-info {
            background: linear-gradient(135deg, #0dcaf0, #38bdf8);
            --icon-shadow: rgba(13, 202, 240, 0.4);
            color: #fff;
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
                    <div class="icon-box icon-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                            class="bi bi-hdd-stack" viewBox="0 0 16 16">
                            <path
                                d="M2.5 6a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zm0-1h11A1.5 1.5 0 0 1 15 6.5v3a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 9.5v-3A1.5 1.5 0 0 1 2.5 5z" />
                            <path
                                d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0m6.5 1a.5.5 0 0 0 .5-.5.5.5 0 0 0-.5-.5h-4a.5.5 0 0 0 0 1zm0-2A1.5 1.5 0 0 1 13 8.5 1.5 1.5 0 0 1 11.5 10h-4A1.5 1.5 0 0 1 6 8.5 1.5 1.5 0 0 1 7.5 7zM2.5 11a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zm0-1h11a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5v-3A1.5 1.5 0 0 1 2.5 10" />
                            <path
                                d="M5 13a1 1 0 1 1-2 0 1 1 0 0 1 2 0m6.5 1a.5.5 0 0 0 .5-.5.5.5 0 0 0-.5-.5h-4a.5.5 0 0 0 0 1zm0-2a1.5 1.5 0 0 1 1.5 1.5 1.5 1.5 0 0 1-1.5 1.5h-4A1.5 1.5 0 0 1 6 13.5 1.5 1.5 0 0 1 7.5 12z" />
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
                    <div class="icon-box icon-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                            class="bi bi-bookmark-star" viewBox="0 0 16 16">
                            <path
                                d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z" />
                            <path
                                d="M7.84 4.114A.5.5 0 0 1 8.187 4l.348.958.958.348a.5.5 0 0 1 0 .94l-.958.348-.348.958a.5.5 0 0 1-.94 0l-.348-.958-.958-.348a.5.5 0 0 1 0-.94l.958-.348z" />
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
                    <div class="icon-box icon-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                            class="bi bi-person-workspace" viewBox="0 0 16 16">
                            <path
                                d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-5.95a3 3 0 1 0 0-6 3 3 0 0 0 0 6M8 1a1 1 0 0 1 1 1v.334a1 1 0 0 1-.008.126A5 5 0 0 1 12.5 2.5a.5.5 0 0 1 0 1H10a.5.5 0 0 0 0 1h4a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2.5a.5.5 0 0 1 0-1H14V5.5h-4a1.5 1.5 0 0 1 0-3h.5A4 4 0 0 0 7 3.293V4a1 1 0 0 1-2 0V1a1 1 0 0 1 1-1z" />
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

    <!-- Pemanggilan library lokal yang sudah didownload -->
    <script src="{{ asset('js/chart.min.js') }}"></script>
    <script>
    const ctx = document.getElementById('kategoriChart').getContext('2d');

    // Gradient warna untuk bar
    const gradientFill = ctx.createLinearGradient(0, 0, 0, 300);
    gradientFill.addColorStop(0, 'rgba(13, 110, 253, 0.95)');
    gradientFill.addColorStop(1, 'rgba(13, 110, 253, 0.35)');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Jumlah Alat',
                data: {!! json_encode($chartData) !!},
                backgroundColor: gradientFill,
                borderColor: 'rgba(13, 110, 253, 1)',
                borderWidth: 1.5,
                borderRadius: 10,
                borderSkipped: false,
                maxBarThickness: 48,
                hoverBackgroundColor: 'rgba(13, 110, 253, 1)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            animation: {
                duration: 900,
                easing: 'easeOutQuart'
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#212529',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    padding: 12,
                    cornerRadius: 8,
                    displayColors: false,
                    titleFont: { weight: 'bold' },
                    callbacks: {
                        label: function(context) {
                            return ' ' + context.parsed.y + ' Alat';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        color: '#6c757d',
                        font: { size: 12 }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false
                    }
                },
                x: {
                    ticks: {
                        color: '#6c757d',
                        font: { size: 12, weight: '500' }
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
@endsection