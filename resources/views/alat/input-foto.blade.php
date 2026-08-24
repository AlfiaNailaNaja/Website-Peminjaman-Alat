<div class="mb-3">
    <label for="foto" class="form-label">Foto Alat</label>
    <input 
        type="file" 
        class="form-control @error('foto') is-invalid @enderror" 
        id="foto" 
        name="foto"
        accept="image/jpeg,image/png"
    >
    
    @error('foto')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    @if ($alat->exists && $alat->foto)
        <div class="mt-2">
            <p class="form-text mb-1">Foto saat ini:</p>
            <img 
                src="{{ asset('gambar/alat/' . $alat->foto) }}" 
                alt="{{ $alat->nama }}" 
                class="rounded border" 
                width="100" 
                height="100" 
                style="object-fit: cover;"
            >
            <div class="form-text mt-1">
                Biarkan kosong bila tidak ingin mengganti foto.
            </div>
        </div>
    @endif
</div>