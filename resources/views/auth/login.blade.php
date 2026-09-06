@extends('layouts.utama')

@section('judul', 'Masuk')

@section('konten')
<style>
    .login-wrap {
        min-height: calc(100vh - 220px);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .login-card {
        border: 1px solid #E4E7EC;
        border-radius: 12px;
        box-shadow: 0 12px 28px rgba(16, 27, 51, 0.14), 0 3px 8px rgba(16, 27, 51, 0.08) !important;
    }
    .login-card .card-body {
        padding: 40px 36px;
    }
    .app-logo-login {
        width: 100px;
        height: auto;
        max-height: 80px;
        object-fit: contain;
        margin: 0 auto 16px;
        display: block;
    }
    .login-card .card-title {
        font-size: 20px;
        font-weight: 500;
        color: #101B33;
    }
    .login-card .subtitle {
        color: #6B7280;
        font-size: 13px;
    }
    .login-card .form-control:focus {
        border-color: #1B3A63;
        box-shadow: 0 0 0 3px rgba(27, 58, 99, 0.15);
    }
    .btn-login {
        background: #1B3A63;
        border-color: #1B3A63;
        color: #fff;
        padding: 11px;
        font-size: 14px;
        font-weight: 500;
        border-radius: 8px;
    }
    .btn-login:hover {
        background: #16304F;
        border-color: #16304F;
        color: #fff;
    }
</style>

<div class="login-wrap">
    <div class="row justify-content-center w-100">
        <div class="col-md-5">
            <div class="card login-card shadow-sm">
                <div class="card-body">

                    <div class="text-center mb-4">
                        <!-- LOGO APLIKASI -->
                        <img src="{{ asset('gambar/logo.png') }}" alt="Logo Aplikasi" class="app-logo-login">
                        
                        <h4 class="card-title mb-1">Masuk ke Sistem</h4>
                        <p class="subtitle mb-0">Masukkan kredensial untuk mengakses dashboard.</p>
                    </div>

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
</div>
@endsection