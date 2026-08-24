<div class="table-responsive">
    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>Kode Pinjam</th>
                <th>Tanggal Pinjam</th>
                <th>Harus Kembali</th>
                <th class="text-center">Jumlah Alat</th>
                <th>Status</th>
                <th style="width: 150px" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($daftarPeminjaman as $peminjaman)
                <tr>
                    <td><code>{{ $peminjaman->kode_pinjam }}</code></td>
                    <td>{{ $peminjaman->tgl_pinjam->format('d/m/Y') }}</td>
                    <td>
                        {{ $peminjaman->tgl_harus_kembali->format('d/m/Y') }}
                        @if ($peminjaman->lewatTenggat())
                            <span class="badge bg-danger ms-1">Lewat Tenggat</span>
                        @endif
                    </td>
                    <td class="text-center">{{ $peminjaman->detail->count() }}</td>
                    <td>
                        <span class="badge bg-{{ $peminjaman->status->warna() }}">
                            {{ $peminjaman->status->label() }}
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('peminjaman.rincian', $peminjaman) }}" class="btn btn-sm btn-outline-primary">
                            Rincian
                        </a>

                        @if ($peminjaman->status === \App\Enums\StatusPeminjaman::Dipinjam)
                            <form method="POST" action="{{ route('pengembalian.ajukan', $peminjaman) }}" class="d-inline"
                                onsubmit="return confirm('Ajukan pengembalian seluruh alat?')">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Kembalikan</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        Belum ada pengajuan peminjaman.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>