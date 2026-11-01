@extends('Admin.layouts.app')

@section('title', 'Tambah Kendaraan')

@section('content')
    @include('Admin.partials.page-heading', [
        'title' => 'Tambah Kendaraan',
        'description' => 'Masukkan informasi kendaraan yang akan ditampilkan di showroom.',
    ])
    @include('Admin.partials.feedback')

    <section class="card">
        <div class="card-body">
            <form action="{{ route('kendaraan.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12 md:col-span-6">
                        <label for="nama_kendaraan" class="mb-2 block font-medium">Nama Kendaraan</label>
                        <input id="nama_kendaraan" type="text" name="nama_kendaraan" class="form-control"
                            value="{{ old('nama_kendaraan') }}" placeholder="Contoh: Honda Civic" required>
                        @error('nama_kendaraan') <p class="text-xs text-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="col-span-12 md:col-span-6">
                        <label for="merek" class="mb-2 block font-medium">Merek</label>
                        <input id="merek" type="text" name="merek" class="form-control"
                            value="{{ old('merek') }}" placeholder="Contoh: Honda" required>
                        @error('merek') <p class="text-xs text-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="col-span-12 md:col-span-6">
                        <label for="tahun" class="mb-2 block font-medium">Tahun</label>
                        <input id="tahun" type="number" name="tahun" class="form-control"
                            value="{{ old('tahun') }}" min="1900" max="2026" placeholder="Contoh: 2022" required>
                        @error('tahun') <p class="text-xs text-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="col-span-12 md:col-span-6">
                        <label for="harga" class="mb-2 block font-medium">Harga (Rp)</label>
                        <input id="harga" type="number" name="harga" class="form-control"
                            value="{{ old('harga') }}" min="0" step="0.01" placeholder="Contoh: 250000000" required>
                        @error('harga') <p class="text-xs text-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="col-span-12 md:col-span-6">
                        <label for="kondisi" class="mb-2 block font-medium">Kondisi</label>
                        <select id="kondisi" name="kondisi" class="form-control" required>
                            <option value="">-- Pilih Kondisi --</option>
                            <option value="Bekas" {{ old('kondisi') == 'Bekas' ? 'selected' : '' }}>Bekas</option>
                            <option value="Sangat Baik" {{ old('kondisi') == 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
                        </select>
                        @error('kondisi') <p class="text-xs text-error">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="mt-6 flex flex-wrap gap-3">
                    <button type="submit" class="btn bg-primary text-white">Simpan Kendaraan</button>
                    <a href="{{ route('kendaraan.index') }}" class="btn btn-outline-primary">Batal</a>
                </div>
            </form>
        </div>
    </section>
@endsection
