<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Peminjam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* PENTING: reset ini yang bikin lebar kolom presisi */
        *, *::before, *::after {
            box-sizing: border-box;
        }

        html, body {
            overflow-x: hidden;
        }

        body {
            margin: 0;
        }

        .register-wrap {
            width: 100%;
            min-height: 100vh;
            display: flex;
        }

        .register-row {
            display: flex;
            width: 100%;
            align-items: stretch;
        }

        /* ===== PANEL KIRI (BRANDING) ===== */
        .register-brand {
            flex: 0 0 42%;
            max-width: 42%;
            background: #233044;
            padding: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FFFFFF;
        }

        .register-brand-inner {
            width: 100%;
            max-width: 380px;
        }

        .register-badge {
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

        .register-badge .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #60A5FA;
            display: inline-block;
        }

        .register-brand h2 {
            font-size: 32px;
            font-weight: 800;
            line-height: 1.3;
            letter-spacing: -0.01em;
            margin-bottom: 16px;
        }

        .register-brand h2 span {
            color: #60A5FA;
        }

        .register-brand p {
            font-size: 15px;
            color: #CBD5E1;
            line-height: 1.7;
            margin-bottom: 0;
        }

        /* ===== PANEL KANAN (FORM) ===== */
        .register-form-panel {
            flex: 1 1 0%;
            min-width: 0;
            background: #FFFFFF;
            padding: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-y: auto;
        }

        .register-form-inner {
            width: 100%;
            max-width: 380px;
        }

        .register-form-panel .card-title {
            font-size: 24px;
            font-weight: 800;
            color: #0F172A;
            letter-spacing: -0.01em;
            margin-bottom: 6px;
        }

        .register-form-panel .subtitle {
            color: #64748B;
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 28px;
        }

        .register-form-panel .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #334155;
        }

        .register-form-panel .form-control {
            border-radius: 10px;
            padding: 10px 14px;
            border-color: #E2E8F0;
        }

        .register-form-panel .form-control:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        .btn-register {
            background: #0F172A;
            border-color: #0F172A;
            color: #FFFFFF;
            padding: 13px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.25s ease;
        }

        .btn-register:hover {
            background: #1E293B;
            border-color: #1E293B;
            color: #FFFFFF;
        }

        .register-form-panel small a {
            color: #2563EB;
            font-weight: 600;
            text-decoration: none;
        }

        .register-form-panel small a:hover {
            text-decoration: underline;
        }

        /* Responsif: panel branding di layar kecil */
        @media (max-width: 767.98px) {
            .register-row {
                flex-direction: column;
            }
            .register-wrap {
                min-height: auto;
            }
            .register-brand {
                flex: none;
                max-width: 100%;
                padding: 40px 32px;
            }
            .register-form-panel {
                padding: 40px 32px;
            }
        }
    </style>
</head>
<body>
<div class="register-wrap">
    <div class="register-row">

        <!-- PANEL KIRI: BRANDING -->
        <div class="register-brand">
            <div class="register-brand-inner">
                <span class="register-badge"><span class="dot"></span> Sistem Peminjaman Alat Lab</span>

                <h2>Buat Akun <span>Peminjam</span></h2>
                <p>Daftarkan diri Anda untuk mulai mengajukan peminjaman alat, melihat katalog, dan memantau status pengembalian dengan mudah.</p>
            </div>
        </div>

        <!-- PANEL KANAN: FORM PENDAFTARAN -->
        <div class="register-form-panel">
            <div class="register-form-inner">
                <h4 class="card-title mb-0">Pendaftaran Akun Peminjam</h4>
                <p class="subtitle">Lengkapi data di bawah untuk membuat akun baru.</p>

                <form method="POST" action="{{ route('peminjam.daftar.store') }}">
                    @csrf

                    <!-- Nama Lengkap (Wajib) -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required autofocus>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Username (Wajib) -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email (Opsional) -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-muted">(Opsional)</span></label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- No Telp / WA (Opsional) -->
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No. Telepon / WhatsApp <span class="text-muted">(Opsional)</span></label>
                        <input type="text" id="no_telp" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" value="{{ old('no_telp') }}">
                        @error('no_telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password (Wajib) -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password (Wajib) -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-register w-100 mt-2">Daftar Sekarang</button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <small>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></small>
                </div>
            </div>
        </div>

    </div>
</div>
</body>
</html>