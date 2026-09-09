@extends('layouts.utama')

@section('judul', 'Selamat Datang')

@section('konten')
<style>
    /* ================= HERO SECTION ================= */
    .hero-section {
        position: relative;
        background: linear-gradient(135deg, #FFFFFF 0%, #F1F5F9 100%);
        border: 1px solid #E2E8F0;
        border-radius: 24px;
        padding: 64px 48px;
        margin-bottom: 56px;
        overflow: hidden;
        isolation: isolate;
    }

    /* Blob dekoratif di background hero */
    .hero-section::before {
        content: '';
        position: absolute;
        width: 480px;
        height: 480px;
        background: radial-gradient(circle, rgba(37, 99, 235, 0.14) 0%, rgba(255,255,255,0) 70%);
        top: -220px;
        right: -160px;
        border-radius: 50%;
        z-index: -1;
    }
    .hero-section::after {
        content: '';
        position: absolute;
        width: 320px;
        height: 320px;
        background: radial-gradient(circle, rgba(29, 78, 216, 0.10) 0%, rgba(255,255,255,0) 70%);
        bottom: -180px;
        left: -120px;
        border-radius: 50%;
        z-index: -1;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #EFF6FF;
        color: #1D4ED8;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        padding: 8px 16px;
        border-radius: 999px;
        margin-bottom: 20px;
        border: 1px solid rgba(37, 99, 235, 0.2);
    }

    .hero-badge .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #2563EB;
        display: inline-block;
    }

    .hero-title {
        font-size: 38px;
        font-weight: 800;
        color: #0F172A;
        line-height: 1.22;
        letter-spacing: -0.02em;
        margin-bottom: 18px;
    }

    .hero-title span {
        background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .lead-text {
        font-size: 16px;
        color: #475569;
        line-height: 1.65;
        margin-bottom: 32px;
        max-width: 480px;
    }

    .btn-navy {
        background: #0F172A;
        border-color: #0F172A;
        color: #FFFFFF;
        padding: 14px 32px;
        font-size: 15px;
        font-weight: 600;
        border-radius: 12px;
        transition: all 0.25s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.12);
    }

    .btn-navy:hover {
        background: #1E293B;
        border-color: #1E293B;
        color: #FFFFFF;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px -5px rgba(15, 23, 42, 0.25);
    }

    /* Mini stats di bawah tombol hero */
    .hero-stats {
        display: flex;
        gap: 32px;
        margin-top: 40px;
        flex-wrap: wrap;
    }

    .hero-stats .stat-num {
        font-size: 22px;
        font-weight: 800;
        color: #0F172A;
        line-height: 1;
        margin-bottom: 4px;
    }

    .hero-stats .stat-label {
        font-size: 13px;
        color: #64748B;
        font-weight: 500;
    }

    /* Logo floating card */
    .logo-wrapper {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 32px;
        border-radius: 28px;
        background: #FFFFFF;
        box-shadow: 0 24px 48px -18px rgba(37, 99, 235, 0.22);
        border: 1px solid rgba(226, 232, 240, 0.9);
    }

    .logo-wrapper::before {
    content: '';
    position: absolute;
    width: 120%;
    height: 120%;
    background: radial-gradient(circle, rgba(37, 99, 235, 0.18) 0%, rgba(255, 255, 255, 0) 70%);
    top: -10%;
    left: -10%;
    z-index: 0;
    border-radius: 50%;
    filter: blur(10px);
}

    .logo-wrapper::after {
        content: '';
        position: absolute;
        width: 120%;
        height: 120%;
        background: radial-gradient(circle, rgba(37, 99, 235, 0.18) 0%, rgba(255, 255, 255, 0) 70%);
        top: -10%;
        left: -10%;
        z-index: 0;
        border-radius: 50%;
        filter: blur(10px);
    }

    @keyframes spin-slow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .app-logo {
        width: 140px;
        height: auto;
        max-height: 120px;
        object-fit: contain;
        position: relative;
        z-index: 1;
        transition: transform 0.3s ease;
    }

    .logo-wrapper:hover .app-logo {
        transform: scale(1.05);
    }

    /* ================= FITUR UNGGULAN ================= */
    .feat-eyebrow {
        text-align: center;
        font-size: 13px;
        font-weight: 700;
        color: #2563EB;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 10px;
    }

    .feat-heading {
        text-align: center;
        font-size: 26px;
        font-weight: 700;
        color: #0F172A;
        max-width: 600px;
        margin: 0 auto 48px;
        line-height: 1.4;
    }

    .feat-card {
        position: relative;
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-left: 3px solid transparent;
        border-radius: 16px;
        padding: 28px 24px;
        height: 100%;
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        overflow: hidden;
    }

    .feat-card:hover {
        transform: translateY(-6px);
        border-color: #E2E8F0;
        border-left-color: #2563EB;
        box-shadow: 0 16px 32px -8px rgba(15, 23, 42, 0.10);
    }

    .feat-num {
        position: absolute;
        top: 16px;
        right: 20px;
        font-size: 34px;
        font-weight: 800;
        color: #F1F5F9;
        line-height: 1;
        z-index: 0;
        transition: color 0.25s ease;
    }

    .feat-card:hover .feat-num {
        color: #EFF6FF;
    }

    .feat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: #EFF6FF;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
        position: relative;
        z-index: 1;
    }

    .feat-icon i {
        font-size: 22px;
        color: #2563EB;
    }

    .feat-card p.feat-title {
        font-size: 16px;
        font-weight: 600;
        color: #0F172A;
        margin-bottom: 8px;
        position: relative;
        z-index: 1;
    }

    .feat-card p.feat-desc {
        font-size: 14px;
        color: #64748B;
        line-height: 1.6;
        margin-bottom: 0;
        position: relative;
        z-index: 1;
    }

    /* ================= CTA STRIP BAWAH ================= */
    .cta-strip {
        background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%);
        border-radius: 20px;
        padding: 44px 40px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
        color: #FFFFFF;
        margin-bottom: 24px;
    }

    .cta-strip h3 {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .cta-strip p {
        font-size: 14px;
        color: #CBD5E1;
        margin-bottom: 0;
    }

    .btn-cta-light {
        background: #FFFFFF;
        color: #0F172A;
        padding: 12px 28px;
        font-size: 14px;
        font-weight: 700;
        border-radius: 12px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.25s ease;
        white-space: nowrap;
    }

    .btn-cta-light:hover {
        background: #F1F5F9;
        transform: translateY(-2px);
    }
</style>

<!-- HERO SECTION -->
<div class="hero-section shadow-sm">
    <div class="row align-items-center g-5">
        <!-- TEKS DAN TOMBOL (KIRI) -->
        <div class="col-lg-7 text-start">
            <span class="hero-badge"><span class="dot"></span> Sistem Peminjaman Alat Lab</span>
            <h1 class="hero-title">
                Kelola peminjaman alat <span>lebih mudah</span> dan tercatat rapi
            </h1>
            <p class="lead-text">
                Satu platform untuk mencatat peminjaman, pengembalian, dan riwayat alat laboratorium secara real-time.
            </p>
            <div>
                <a href="{{ route('login') }}" class="btn btn-navy">
                    <i class="bi bi-box-arrow-in-right fs-5"></i>
                    <span>Mulai Masuk</span>
                </a>
            </div>

            <div class="hero-stats">
                <div>
                    <div class="stat-num">100%</div>
                    <div class="stat-label">Real-time & tercatat</div>
                </div>
                <div>
                    <div class="stat-num">3</div>
                    <div class="stat-label">Level akses pengguna</div>
                </div>
               
            </div>
        </div>

        <!-- LOGO (KANAN) -->
        <div class="col-lg-5 text-center">
            <div class="logo-wrapper">
                <img src="{{ asset('gambar/logo.png') }}" alt="Logo Aplikasi" class="app-logo">
            </div>
        </div>
    </div>
</div>

<!-- FITUR UNGGULAN -->
<div class="mb-5">
    <p class="feat-eyebrow">Fitur Unggulan</p>
    <p class="feat-heading">Transformasi digital laboratorium: akurat, transparan, dan terintegrasi</p>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

        <div class="col">
            <div class="feat-card">
                <span class="feat-num">01</span>
                <div class="feat-icon"><i class="bi bi-cart3"></i></div>
                <p class="feat-title">Katalog & Pemesanan Mandiri</p>
                <p class="feat-desc">Pilih alat lewat katalog digital dengan stok real-time, bisa pinjam beberapa alat sekaligus dalam satu pengajuan.</p>
            </div>
        </div>

        <div class="col">
            <div class="feat-card">
                <span class="feat-num">02</span>
                <div class="feat-icon"><i class="bi bi-arrow-return-left"></i></div>
                <p class="feat-title">Verifikasi Pengembalian</p>
                <p class="feat-desc">Proses verifikasi dan pemeriksaan kondisi alat saat dikembalikan tercatat transparan oleh petugas lab.</p>
            </div>
        </div>

        <div class="col">
            <div class="feat-card">
                <span class="feat-num">03</span>
                <div class="feat-icon"><i class="bi bi-cash-stack"></i></div>
                <p class="feat-title">Denda Otomatis & Berkeadilan</p>
                <p class="feat-desc">Keterlambatan dihitung otomatis per hari dan langsung berhenti setelah alat dilaporkan kembali.</p>
            </div>
        </div>

        <div class="col">
            <div class="feat-card">
                <span class="feat-num">04</span>
                <div class="feat-icon"><i class="bi bi-boxes"></i></div>
                <p class="feat-title">Inventaris Cerdas</p>
                <p class="feat-desc">Stok alat selalu akurat dan otomatis menyusut atau diperbarui saat terjadi kerusakan/kehilangan.</p>
            </div>
        </div>

        <div class="col">
            <div class="feat-card">
                <span class="feat-num">05</span>
                <div class="feat-icon"><i class="bi bi-clock-history"></i></div>
                <p class="feat-title">Audit Trail & Transparansi</p>
                <p class="feat-desc">Setiap aktivitas transaksi peminjaman tercatat secara mendalam dan siap diekspor menjadi laporan cetak/PDF.</p>
            </div>
        </div>

        <div class="col">
            <div class="feat-card">
                <span class="feat-num">06</span>
                <div class="feat-icon"><i class="bi bi-shield-lock"></i></div>
                <p class="feat-title">Keamanan & Kontrol Akses</p>
                <p class="feat-desc">Hak akses terisolasi dengan aman sesuai peran pengguna, baik untuk Admin, Petugas, maupun Peminjam.</p>
            </div>
        </div>

    </div>
</div>

<!-- CTA STRIP -->
<div class="cta-strip">
    <div>
        <h3>Siap mulai kelola peminjaman alat lab Anda?</h3>
        <p>Masuk sekarang dan rasakan proses pencatatan yang lebih rapi dan transparan.</p>
    </div>
    <a href="{{ route('login') }}" class="btn-cta-light">
        <i class="bi bi-box-arrow-in-right"></i>
        <span>Mulai Sekarang</span>
    </a>
</div>
@endsection