<div class="card shadow-sm">
    <div class="card-header bg-light">
        <h6 class="card-title mb-0 fw-bold">Alat yang Diajukan</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Alat</th>
                        <th class="text-center">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($isiKeranjang as $baris)
                        <tr>
                            <td><code>{{ $baris->alat->kode_alat }}</code></td>
                            <td>{{ $baris->alat->nama }}</td>
                            <td class="text-center fw-bold">{{ $baris->jumlah }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>