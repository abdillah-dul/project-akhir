@extends('Admin.layouts.app')

@section('title', 'Pemesanan Servis')

@section('content')
    @include('Admin.partials.page-heading', [
        'title' => 'Pemesanan Servis',
        'description' => 'Kelola jadwal servis pelanggan dan kendaraan.',
        'actionUrl' => route('pemesanan-servis.create'),
        'actionLabel' => '+ Tambah Pemesanan',
    ])
    @include('Admin.partials.feedback')

    <section class="card">
        <div class="card-body">
            <div class="overflow-x-auto">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Pelanggan</th>
                            <th scope="col">Kendaraan</th>
                            <th scope="col">Layanan</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Biaya</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pemesananServis as $booking)
                            <tr>
                                <td>{{ $pemesananServis->firstItem() + $loop->index }}</td>
                                <td>{{ $booking->nama_pelanggan }}</td>
                                <td>{{ $booking->nama_kendaraan }}</td>
                                <td>{{ $booking->nama_layanan }}</td>
                                <td>{{ \Illuminate\Support\Carbon::parse($booking->tanggal_servis)->format('d-m-Y') }}</td>
                                <td>Rp {{ number_format((float) $booking->biaya, 0, ',', '.') }}</td>
                                <td>{{ $booking->status }}</td>
                                <td>
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('pemesanan-servis.edit', $booking->id) }}"
                                            class="btn btn-outline-primary">Edit</a>
                                        <form action="{{ route('pemesanan-servis.destroy', $booking->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn bg-error text-white"
                                                onclick="return confirm('Hapus pemesanan servis ini?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-4 text-center text-bodytext">Belum ada pemesanan servis.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $pemesananServis->links() }}
        </div>
    </section>
@endsection
