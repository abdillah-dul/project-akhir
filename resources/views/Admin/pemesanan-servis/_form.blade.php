<div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 md:col-span-6">
        <label for="pelanggan_id" class="mb-2 block font-medium">Pelanggan</label>
        <select id="pelanggan_id" name="pelanggan_id" class="form-control" required>
            <option value="">Pilih pelanggan</option>
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}"
                    @selected((string) old('pelanggan_id', $pemesananServis->pelanggan_id ?? '') === (string) $customer->id)>
                    {{ $customer->nama }}
                </option>
            @endforeach
        </select>
        @error('pelanggan_id') <p class="text-xs text-error">{{ $message }}</p> @enderror
    </div>
    <div class="col-span-12 md:col-span-6">
        <label for="kendaraan_id" class="mb-2 block font-medium">Kendaraan</label>
        <select id="kendaraan_id" name="kendaraan_id" class="form-control" required>
            <option value="">Pilih kendaraan</option>
            @foreach ($vehicles as $vehicle)
                <option value="{{ $vehicle->id }}"
                    @selected((string) old('kendaraan_id', $pemesananServis->kendaraan_id ?? '') === (string) $vehicle->id)>
                    {{ $vehicle->nama_kendaraan }}
                </option>
            @endforeach
        </select>
        @error('kendaraan_id') <p class="text-xs text-error">{{ $message }}</p> @enderror
    </div>
    <div class="col-span-12 md:col-span-6">
        <label for="layanan_servis_id" class="mb-2 block font-medium">Layanan</label>
        <select id="layanan_servis_id" name="layanan_servis_id" class="form-control" required>
            <option value="">Pilih layanan</option>
            @foreach ($services as $service)
                <option value="{{ $service->id }}"
                    @selected((string) old('layanan_servis_id', $pemesananServis->layanan_servis_id ?? '') === (string) $service->id)>
                    {{ $service->nama }} — Rp {{ number_format((float) $service->harga, 0, ',', '.') }}
                </option>
            @endforeach
        </select>
        @error('layanan_servis_id') <p class="text-xs text-error">{{ $message }}</p> @enderror
    </div>
    <div class="col-span-12 md:col-span-6">
        <label for="tanggal_servis" class="mb-2 block font-medium">Tanggal Servis</label>
        <input id="tanggal_servis" type="date" name="tanggal_servis" class="form-control"
            value="{{ old('tanggal_servis', $pemesananServis->tanggal_servis ?? '') }}" required>
        @error('tanggal_servis') <p class="text-xs text-error">{{ $message }}</p> @enderror
    </div>
    <div class="col-span-12 md:col-span-6">
        <label for="status" class="mb-2 block font-medium">Status</label>
        <select id="status" name="status" class="form-control" required>
            @foreach ($statuses as $status)
                <option value="{{ $status }}"
                    @selected(old('status', $pemesananServis->status ?? 'Menunggu') === $status)>
                    {{ $status }}
                </option>
            @endforeach
        </select>
        @error('status') <p class="text-xs text-error">{{ $message }}</p> @enderror
    </div>
    <div class="col-span-12">
        <label for="keluhan" class="mb-2 block font-medium">Keluhan</label>
        <textarea id="keluhan" name="keluhan" class="form-control" rows="4" maxlength="1000" required>{{ old('keluhan', $pemesananServis->keluhan ?? '') }}</textarea>
        @error('keluhan') <p class="text-xs text-error">{{ $message }}</p> @enderror
    </div>
</div>
