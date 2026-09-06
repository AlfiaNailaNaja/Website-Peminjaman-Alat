@extends('layouts.utama')

@section('judul', 'Selamat Datang')

@section('konten')
<style>
    /* HERO SECTION */
    .hero-section {
        text-align: center;
        padding: 64px 32px 56px;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        margin-bottom: 48px;
    }

    .app-logo {
        width: 130px;
        height: auto;
        max-height: 100px;
        object-fit: contain;
        margin-bottom: 24px;
    }

    .hero-section h1 {
        font-size: 32px;
        font-weight: 700;
        color: #0F172A;
        max-width: 640px;
        margin: 0 auto 16px;
        line-height: 1.35;
        letter-spacing: -0.02em;
    }

    .hero-section p.lead-text {
        font-size: 16px;
        color: #475569;
        max-width: 520px;
        margin: 0 auto 32px;
        line-height: 1.6;
    }

    .btn-navy {
        background: #0F172A;
        border-color: #0F172A;
        color: #FFFFFF;
        padding: 14px 32px;
        font-size: 15px;
        font-weight: 600;
        border-radius: 10px;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-navy:hover {
        background: #1E293B;
        border-color: #1E293B;
        color: #FFFFFF;
        transform: translateY(-2px);
        box-shadow: 0 8px 16px -4px rgba(15, 23, 42, 0.15);
    }

    /* FITUR UNGGULAN SECTION */
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
        font-size: 22px;
        font-weight: 700;
        color: #0F172A;
        max-width: 540px;
        margin: 0 auto 40px;
        line-height: 1.4;
    }

    .feat-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 28px 24px;
        height: 100%;
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }

    .feat-card:hover {
        transform: translateY(-4px);
        border-color: #CBD5E1;
        box-shadow: 0 12px 28px -6px rgba(15, 23, 42, 0.08);
    }

    .feat-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        background: #EFF6FF;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
    }

    .feat-icon i {
        font-size: 20px;
        color: #2563EB;
    }

    .feat-card p.feat-title {
        font-size: 16px;
        font-weight: 600;
        color: #0F172A;
        margin-bottom: 8px;
    }

    .feat-card p.feat-desc {
        font-size: 14px;
        color: #64748B;
        line-height: 1.6;
        margin-bottom: 0;
    }
</style>

<!-- HERO SECTION -->
<div class="hero-section shadow-sm">
    <!-- LOGO APLIKASI -->
    <img src="{{ asset('gambar/logo.png') }}" alt="Logo Aplikasi" class="app-logo">

    <h1>Kelola peminjaman alat lebih mudah dan tercatat rapi</h1>
    <p class="lead-text">Satu platform untuk mencatat peminjaman, pengembalian, dan riwayat alat laboratorium secara real-time.</p>
    
    <!-- TOMBOL DENGAN IKON MASUK -->
    <a href="{{ route('login') }}" class="btn btn-navy">
        <i class="bi bi-box-arrow-in-right fs-5"></i>
        <span>Mulai Masuk</span>
    </a>
</div>

<!-- FITUR UNGGULAN -->
<div class="mb-5">
    <p class="feat-eyebrow">Fitur Unggulan</p>
    <p class="feat-heading">Transformasi digital laboratorium: akurat, transparan, dan terintegrasi</p>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

        <!-- Card 1 -->
        <div class="col">
            <div class="feat-card">
                <div class="feat-icon"><i class="bi bi-cart3"></i></div>
                <p class="feat-title">Katalog & Pemesanan Mandiri</p>
                <p class="feat-desc">Pilih alat lewat katalog digital dengan stok real-time, bisa pinjam beberapa alat sekaligus dalam satu pengajuan.</p>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col">
            <div class="feat-card">
                <div class="feat-icon"><i class="bi bi-arrow-return-left"></i></div>
                <p class="feat-title">Verifikasi Pengembalian</p>
                <p class="feat-desc">Proses verifikasi dan pemeriksaan kondisi alat saat dikembalikan tercatat transparan oleh petugas lab.</p>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col">
            <div class="feat-card">
                <div class="feat-icon"><i class="bi bi-cash-stack"></i></div>
                <p class="feat-title">Denda Otomatis & Berkeadilan</p>
                <p class="feat-desc">Keterlambatan dihitung otomatis per hari dan langsung berhenti setelah alat dilaporkan kembali.</p>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col">
            <div class="feat-card">
                <div class="feat-icon"><i class="bi bi-boxes"></i></div>
                <p class="feat-title">Inventaris Cerdas</p>
                <p class="feat-desc">Stok alat selalu akurat dan otomatis menyusut atau diperbarui saat terjadi kerusakan/kehilangan.</p>
            </div>
        </div>

        <!-- Card 5 -->
        <div class="col">
            <div class="feat-card">
                <div class="feat-icon"><i class="bi bi-clock-history"></i></div>
                <p class="feat-title">Audit Trail & Transparansi</p>
                <p class="feat-desc">Setiap aktivitas transaksi peminjaman tercatat secara mendalam dan siap diekspor menjadi laporan cetak/PDF.</p>
            </div>
        </div>

        <!-- Card 6 -->
        <div class="col">
            <div class="feat-card">
                <div class="feat-icon"><i class="bi bi-shield-lock"></i></div>
                <p class="feat-title">Keamanan & Kontrol Akses</p>
                <p class="feat-desc">Hak akses terisolasi dengan aman sesuai peran pengguna, baik untuk Admin, Petugas, maupun Peminjam.</p>
            </div>
        </div>

    </div>
</div>
@endsection