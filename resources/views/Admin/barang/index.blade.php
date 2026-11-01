@extends('Admin.layouts.app')

@section('title', 'Barang')

@section('content')
    @include('Admin.partials.page-heading', [
        'title' => 'Data Barang',
        'description' => 'Kelola barang, kategori, harga, dan stok showroom.',
        'actionUrl' => route('barang.create'),
        'actionLabel' => '+ Tambah Barang',
    ])

    @include('Admin.partials.feedback')

    <section class="card">
        <div class="card-body">
            <div class="overflow-x-auto">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barang as $b)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="font-semibold">{{ $b->nama_barang }}</td>
                                <td>{{ $b->kategori }}</td>
                                <td>Rp {{ number_format($b->harga, 0, ',', '.') }}</td>
                                <td>{{ $b->stok }}</td>
                                <td>
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('barang.edit', $b->id) }}" class="btn btn-outline-primary">Edit</a>
                                        <form action="{{ route('barang.destroy', $b->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn bg-error text-white"
                                                onclick="return confirm('Hapus barang ini?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-4 text-center text-bodytext">Belum ada data barang.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
