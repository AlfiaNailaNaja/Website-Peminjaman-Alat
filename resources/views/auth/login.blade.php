@extends('layouts.utama')
@section('judul', 'Masuk')
@section('konten')
<style>
    html, body {
        overflow-x: hidden;
    }

    /* Menutupi TOTAL seluruh viewport, termasuk navbar/alert dari layout */
    .login-wrap {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: 1050; /* di atas navbar Bootstrap (biasanya 1030) */
        display: flex;
        background: #FFFFFF; /* fallback biar nggak transparan */
    }

    .login-row {
        display: flex;
        width: 100%;
        align-items: stretch;
    }

    /* ===== PANEL KIRI (BRANDING) ===== */
    .login-brand {
        flex: 0 0 42%;
        background: #233044;
        padding: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #FFFFFF;
    }

    .login-brand-inner {
        width: 100%;
        max-width: 380px;
    }

    .login-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #1E293B;
        color: #93C5FD;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        padding: 6px 14px;
        border-radius: 999px;
        margin-bottom: 24px;
        width: fit-content;
    }

    .login-badge .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #60A5FA;
        display: inline-block;
    }

    .login-brand h2 {
        font-size: 32px;
        font-weight: 800;
        line-height: 1.3;
        letter-spacing: -0.01em;
        margin-bottom: 16px;
    }

    .login-brand h2 span {
        color: #60A5FA;
    }

    .login-brand p {
        font-size: 15px;
        color: #CBD5E1;
        line-height: 1.7;
        margin-bottom: 0;
    }

    /* ===== PANEL KANAN (FORM) ===== */
    .login-form-panel {
        flex: 1;
        background: #FFFFFF;
        padding: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow-y: auto; /* biar tetap bisa discroll kalau konten form panjang / layar pendek */
        max-height: 100vh;
    }

    .login-form-inner {
        width: 100%;
        max-width: 380px;
    }

    .login-form-panel .card-title {
        font-size: 24px;
        font-weight: 800;
        color: #0F172A;
        letter-spacing: -0.01em;
        margin-bottom: 6px;
    }

    .login-form-panel .subtitle {
        color: #64748B;
        font-size: 13px;
        line-height: 1.6;
        margin-bottom: 28px;
    }

    .login-form-panel .form-control:focus {
        border-color: #2563EB;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    }

    .btn-login {
        background: #0F172A;
        border-color: #0F172A;
        color: #FFFFFF;
        padding: 13px;
        font-size: 14px;
        font-weight: 600;
        border-radius: 12px;
        transition: all 0.25s ease;
    }

    .btn-login:hover {
        background: #1E293B;
        border-color: #1E293B;
        color: #FFFFFF;
    }

    /* Responsif: panel branding di layar kecil */
    @media (max-width: 767.98px) {
        .login-row {
            flex-direction: column;
        }
        .login-brand {
            flex: none;
            padding: 40px 32px;
        }
        .login-form-panel {
            padding: 40px 32px;
        }
    }
</style>

<div class="login-wrap">
    <div class="login-row">

        <!-- PANEL KIRI: BRANDING -->
        <div class="login-brand">
            <div class="login-brand-inner">
                <span class="login-badge"><span class="dot"></span> Sistem Peminjaman Alat Lab</span>

                <h2>Selamat Datang <span>Kembali</span></h2>
                <p>Silakan masuk ke akun Anda untuk mengelola peminjaman, melihat katalog alat, dan memantau riwayat pengembalian.</p>
            </div>
        </div>

        <!-- PANEL KANAN: FORM LOGIN -->
        <div class="login-form-panel">
            <div class="login-form-inner">
                <h4 class="card-title mb-0">Masuk ke Sistem</h4>
                <p class="subtitle">Masukkan kredensial untuk mengakses dashboard.</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <x-input name="username" Label="Nama Pengguna" required autofocus />
                    <x-input name="password" label="Kata Sandi" type="password" required value="" />

                    <button type="submit" class="btn btn-login w-100 mt-2">Masuk</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection