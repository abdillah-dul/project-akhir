@extends('Admin.layouts.app')

@section('title', 'Kendaraan')

@section('content')
    @include('Admin.partials.page-heading', [
        'title' => 'Data Kendaraan',
        'description' => 'Kelola kendaraan yang ditampilkan di showroom.',
        'actionUrl' => route('kendaraan.create'),
        'actionLabel' => '+ Tambah Kendaraan',
    ])

    @include('Admin.partials.feedback')

    <section class="card">
        <div class="card-body">
            <div class="overflow-x-auto">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Kendaraan</th>
                            <th scope="col">Merek</th>
                            <th scope="col">Tahun</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Kondisi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kendaraan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="font-semibold">{{ $item->nama_kendaraan }}</td>
                                <td>{{ $item->merek }}</td>
                                <td>{{ $item->tahun }}</td>
                                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge-md bg-lightprimary rounded-full text-primary">
                                        {{ $item->kondisi }}
                                    </span>
                                </td>
                                <td>
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('kendaraan.edit', $item->id) }}" class="btn btn-outline-primary">Edit</a>
                                        <form action="{{ route('kendaraan.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn bg-error text-white"
                                                onclick="return confirm('Yakin ingin menghapus kendaraan ini?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-4 text-center text-bodytext">Belum ada data kendaraan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
