@extends('Admin.layouts.app')

@section('title', 'Tambah Barang')

@section('content')
    @include('Admin.partials.page-heading', [
        'title' => 'Tambah Barang',
        'description' => 'Masukkan informasi barang yang akan dikelola.',
    ])
    @include('Admin.partials.feedback')

    <section class="card">
        <div class="card-body">
            <form action="{{ route('barang.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12 md:col-span-6">
                        <label for="nama_barang" class="mb-2 block font-medium">Nama Barang</label>
                        <input id="nama_barang" type="text" name="nama_barang" class="form-control"
                            value="{{ old('nama_barang') }}" required>
                        @error('nama_barang') <p class="text-xs text-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="col-span-12 md:col-span-6">
                        <label for="kategori" class="mb-2 block font-medium">Kategori</label>
                        <input id="kategori" type="text" name="kategori" class="form-control"
                            value="{{ old('kategori') }}" required>
                        @error('kategori') <p class="text-xs text-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="col-span-12 md:col-span-6">
                        <label for="harga" class="mb-2 block font-medium">Harga (Rp)</label>
                        <input id="harga" type="number" name="harga" class="form-control"
                            min="0" step="0.01" value="{{ old('harga') }}" required>
                        @error('harga') <p class="text-xs text-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="col-span-12 md:col-span-6">
                        <label for="stok" class="mb-2 block font-medium">Stok</label>
                        <input id="stok" type="number" name="stok" class="form-control"
                            min="0" value="{{ old('stok', 0) }}" required>
                        @error('stok') <p class="text-xs text-error">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="mt-6 flex flex-wrap gap-3">
                    <button type="submit" class="btn bg-primary text-white">Simpan Barang</button>
                    <a href="{{ route('barang.index') }}" class="btn btn-outline-primary">Batal</a>
                </div>
            </form>
        </div>
    </section>
@endsection
