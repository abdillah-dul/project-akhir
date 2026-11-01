@extends('Admin.layouts.app')

@section('title', 'Pelanggan')

@section('content')
    @include('Admin.partials.page-heading', [
        'title' => 'Data Pelanggan',
        'description' => 'Kelola profil dan informasi kontak pelanggan.',
        'actionUrl' => route('pelanggan.create'),
        'actionLabel' => '+ Tambah Pelanggan',
    ])

    @include('Admin.partials.feedback')

    <section class="card">
        <div class="card-body">
            <div class="overflow-x-auto">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">No. Telepon</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pelanggan as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="font-semibold">{{ $p->nama }}</td>
                                <td>{{ $p->email }}</td>
                                <td>{{ $p->no_telepon }}</td>
                                <td>{{ $p->alamat }}</td>
                                <td>
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('pelanggan.edit', $p->id) }}" class="btn btn-outline-primary">Edit</a>
                                        <form action="{{ route('pelanggan.destroy', $p->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn bg-error text-white"
                                                onclick="return confirm('Hapus data pelanggan ini?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-4 text-center text-bodytext">Belum ada data pelanggan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
