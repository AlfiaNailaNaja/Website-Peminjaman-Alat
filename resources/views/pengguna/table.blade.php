<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 50px" class="ps-3">No</th>
                        <th>Nama</th>
                        <th>Nama Pengguna</th>
                        <th>Peran</th>
                        <th>Telepon</th>
                        <th>Status</th>
                        <th style="width: 150px" class="text-start pe-3">Aksi</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse ($daftarPengguna as $nomor => $pengguna)
                        <tr>
                            <td class="ps-3">{{ $daftarPengguna->firstItem() + $nomor }}</td>
                            <td>{{ $pengguna->nama }}</td>
                            <td><code>{{ $pengguna->username }}</code></td>
                            <td>
                                @foreach ($pengguna->roles as $peranPengguna)
                                    <span class="badge bg-info text-dark">
                                        {{ ucfirst($peranPengguna->name) }}
                                    </span>
                                @endforeach
                            </td>
                            <td>{{ $pengguna->no_telp ?: '-' }}</td>
                            <td>
                                <span class="badge bg-{{ $pengguna->is_aktif ? 'success' : 'secondary' }}">
                                    {{ $pengguna->is_aktif ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="pe-3">
                                <div class="d-flex align-items-center justify-content-start gap-1">
                                    @php
                                        $hapus = $pengguna->id !== auth()->id() ? route('pengguna.destroy', $pengguna) : null;
                                    @endphp

                                    <x-tombol-aksi 
                                        :ubah="route('pengguna.edit', $pengguna)" 
                                        :hapus="$hapus"
                                        pesanHapus="Yakin ingin menghapus pengguna {{ $pengguna->nama }}?" 
                                    />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Data pengguna tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if ($daftarPengguna->hasPages())
        <div class="card-footer bg-white">
            {{ $daftarPengguna->links() }}
        </div>
    @endif
</div>