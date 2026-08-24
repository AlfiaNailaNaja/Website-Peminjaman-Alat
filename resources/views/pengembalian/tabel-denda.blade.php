<div class="card">
    <div class="card-header">Rincian Denda per Alat</div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0 align-middle">
                <thead>
                    <tr>
                        <th>Nama Alat</th>
                        <th class="text-center">Jumlah</th>
                        <th>Kondisi</th>
                        <th class="text-end">Denda</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengembalian->peminjaman->detail as $baris)
                        <tr>
                            <td>{{ $baris->alat->nama }}</td>
                            <td class="text-center">{{ $baris->jumlah }}</td>
                            <td>{{ ucwords(str_replace('_', ' ', $baris->kondisi_kembali)) }}</td>
                            <td class="text-end">
                                Rp {{ number_format($baris->denda ?? 0, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>