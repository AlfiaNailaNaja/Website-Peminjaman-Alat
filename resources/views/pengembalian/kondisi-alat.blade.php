<div class="card">
    <div class="card-header">Kondisi Alat yang Dikembalikan</div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0 align-middle">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Alat</th>
                        <th class="text-center">Jumlah</th>
                        <th style="width: 200px">Kondisi Kembali</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjaman->detail as $baris)
                        <tr>
                            <td><code>{{ $baris->alat->kode_alat }}</code></td>
                            <td>{{ $baris->alat->nama }}</td>
                            <td class="text-center">{{ $baris->jumlah }}</td>
                            <td>
                                <select name="kondisi[{{ $baris->id }}]" class="form-select form-select-sm @error('kondisi.' . $baris->id) is-invalid @enderror" required>
                                    <option value="baik" {{ old('kondisi.' . $baris->id) == 'baik' ? 'selected' : '' }}>Baik</option>
                                    <option value="rusak_ringan" {{ old('kondisi.' . $baris->id) == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                    <option value="rusak_berat" {{ old('kondisi.' . $baris->id) == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
                                    <option value="hilang" {{ old('kondisi.' . $baris->id) == 'hilang' ? 'selected' : '' }}>Hilang</option>
                                </select>
                                @error('kondisi.' . $baris->id)
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>