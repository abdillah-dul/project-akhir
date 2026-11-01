@extends('Admin.layouts.app')

@section('title', 'Tambah Pelanggan')

@section('content')
    @include('Admin.partials.page-heading', [
        'title' => 'Tambah Pelanggan',
        'description' => 'Masukkan informasi kontak pelanggan.',
    ])
    @include('Admin.partials.feedback')

    <section class="card">
        <div class="card-body">
            <form action="{{ route('pelanggan.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12 md:col-span-6">
                        <label for="nama" class="mb-2 block font-medium">Nama</label>
                        <input id="nama" type="text" name="nama" class="form-control"
                            value="{{ old('nama') }}" required>
                        @error('nama') <p class="text-xs text-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="col-span-12 md:col-span-6">
                        <label for="email" class="mb-2 block font-medium">Email</label>
                        <input id="email" type="email" name="email" class="form-control"
                            value="{{ old('email') }}" required>
                        @error('email') <p class="text-xs text-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="col-span-12 md:col-span-6">
                        <label for="no_telepon" class="mb-2 block font-medium">No. Telepon</label>
                        <input id="no_telepon" type="text" name="no_telepon" class="form-control"
                            value="{{ old('no_telepon') }}" required>
                        @error('no_telepon') <p class="text-xs text-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="col-span-12">
                        <label for="alamat" class="mb-2 block font-medium">Alamat</label>
                        <textarea id="alamat" name="alamat" class="form-control" rows="4" required>{{ old('alamat') }}</textarea>
                        @error('alamat') <p class="text-xs text-error">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="mt-6 flex flex-wrap gap-3">
                    <button type="submit" class="btn bg-primary text-white">Simpan Pelanggan</button>
                    <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-primary">Batal</a>
                </div>
            </form>
        </div>
    </section>
@endsection
