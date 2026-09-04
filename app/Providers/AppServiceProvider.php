<?php

namespace App\Providers;

use App\Enums\StatusPeminjaman;
use App\Listeners\CatatLogout;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\User;
use App\Observers\LogObserver;
use Illuminate\Auth\Events\Logout;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Event::listen(
            Logout::class,
            CatatLogout::class
        );

        Kategori::observe(LogObserver::class);
        Alat::observe(LogObserver::class);
        User::observe(LogObserver::class);

        // Bagikan data antrean Verifikasi dan Persetujuan ke seluruh view/layout
        View::composer('*', function ($view) {
            $jumlahAntrianVerifikasi = Peminjaman::where('status', 'menunggu_verifikasi')->count();
            $jumlahAntrianPersetujuan = Peminjaman::where('status', StatusPeminjaman::Diajukan)->count();

            $view->with('jumlahAntrianVerifikasi', $jumlahAntrianVerifikasi);
            $view->with('jumlahAntrianPersetujuan', $jumlahAntrianPersetujuan);
        });
    }
}