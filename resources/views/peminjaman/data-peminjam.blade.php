<div class="card shadow-sm">
    <div class="card-header bg-light">
        <h6 class="card-title mb-0 fw-bold">Data Peminjaman</h6>
    </div>
    <div class="card-body">
        @error('keranjang')
            <div class="alert alert-danger mb-3">{{ $message }}</div>
        @enderror

        <form method="POST" action="{{ route('peminjaman.simpan') }}">
            @csrf

            {{-- Tanggal Pinjam (Bisa dipilih bebas, validasi di backend) --}}
            <div class="mb-3">
                <x-input label="Tanggal Pinjam" 
                         type="date" 
                         name="tgl_pinjam"
                         :value="old('tgl_pinjam', now()->toDateString())" 
                         required />
            </div>

            {{-- Tanggal Harus Kembali (Bisa dipilih bebas, validasi di backend) --}}
            <div class="mb-3">
                <x-input label="Tanggal Harus Kembali" 
                         type="date" 
                         name="tgl_harus_kembali"
                         :value="old('tgl_harus_kembali', now()->addDays($defaultHari)->toDateString())" 
                         required />
                <div class="form-text">
                    Durasi bawaan {{ $defaultHari }} hari, maksimal {{ $maksHari }} hari.
                </div>
            </div>

            <div class="mb-3">
                <x-textarea label="Keperluan" 
                            name="keperluan" 
                            :value="old('keperluan')" />
            </div>

            <button type="submit" 
                    class="btn btn-primary w-100" 
                    {{ $daftarTunggakan->isNotEmpty() ? 'disabled' : '' }}>
                Kirim Pengajuan
            </button>

            <a href="{{ route('katalog.keranjang') }}" class="btn btn-secondary w-100 mt-2">
                Kembali ke Keranjang
            </a>
        </form>
    </div>
</div>