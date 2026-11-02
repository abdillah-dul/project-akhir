<div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 md:col-span-6">
        <label for="nama" class="mb-2 block font-medium">Nama Layanan</label>
        <input id="nama" type="text" name="nama" class="form-control"
            value="{{ old('nama', $layanan->nama ?? '') }}" maxlength="100" required>
        @error('nama') <p class="text-xs text-error">{{ $message }}</p> @enderror
    </div>
    <div class="col-span-12 md:col-span-6">
        <label for="harga" class="mb-2 block font-medium">Harga (Rp)</label>
        <input id="harga" type="number" name="harga" class="form-control"
            min="0" step="0.01" value="{{ old('harga', $layanan->harga ?? '') }}" required>
        @error('harga') <p class="text-xs text-error">{{ $message }}</p> @enderror
    </div>
    <div class="col-span-12">
        <label for="deskripsi" class="mb-2 block font-medium">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4" maxlength="1000" required>{{ old('deskripsi', $layanan->deskripsi ?? '') }}</textarea>
        @error('deskripsi') <p class="text-xs text-error">{{ $message }}</p> @enderror
    </div>
    <div class="col-span-12 md:col-span-6">
        <label for="estimasi_menit" class="mb-2 block font-medium">Estimasi (menit)</label>
        <input id="estimasi_menit" type="number" name="estimasi_menit" class="form-control"
            min="15" max="1440" value="{{ old('estimasi_menit', $layanan->estimasi_menit ?? 60) }}" required>
        @error('estimasi_menit') <p class="text-xs text-error">{{ $message }}</p> @enderror
    </div>
    <div class="col-span-12 md:col-span-6">
        <input type="hidden" name="is_active" value="0">
        <label for="is_active" class="mb-2 block font-medium">Publikasi</label>
        <label class="flex items-center gap-2">
            <input id="is_active" type="checkbox" name="is_active" value="1"
                @checked((bool) old('is_active', $layanan->is_active ?? true))>
            Tampilkan di halaman Guest
        </label>
        @error('is_active') <p class="text-xs text-error">{{ $message }}</p> @enderror
    </div>
</div>
