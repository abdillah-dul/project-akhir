@extends('Admin.layouts.app')

@section('title', 'Layanan Servis')

@section('content')
    @include('Admin.partials.page-heading', [
        'title' => 'Layanan Servis',
        'description' => 'Kelola katalog layanan bengkel yang ditampilkan kepada pengunjung.',
        'actionUrl' => route('layanan.create'),
        'actionLabel' => '+ Tambah Layanan',
    ])
    @include('Admin.partials.feedback')

    <section class="card">
        <div class="card-body">
            <div class="overflow-x-auto">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Layanan</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Estimasi</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($layanan as $service)
                            <tr>
                                <td>{{ $layanan->firstItem() + $loop->index }}</td>
                                <td>
                                    <span class="font-semibold">{{ $service->nama }}</span>
                                    <span class="block text-sm text-bodytext">{{ $service->deskripsi }}</span>
                                </td>
                                <td>Rp {{ number_format((float) $service->harga, 0, ',', '.') }}</td>
                                <td>{{ $service->estimasi_menit }} menit</td>
                                <td>{{ $service->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                                <td>
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('layanan.edit', $service) }}" class="btn btn-outline-primary">Edit</a>
                                        <form action="{{ route('layanan.destroy', $service) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn bg-error text-white"
                                                onclick="return confirm('Hapus layanan ini?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-4 text-center text-bodytext">Belum ada layanan servis.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $layanan->links() }}
        </div>
    </section>
@endsection
