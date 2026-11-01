@extends('Admin.layouts.app')

@section('title', 'User')

@section('content')
    @include('Admin.partials.page-heading', [
        'title' => 'Data User',
        'description' => 'Kelola akun pengguna yang tercatat di aplikasi.',
        'actionUrl' => route('users.create'),
        'actionLabel' => '+ Tambah User',
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
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="font-semibold">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-primary">Edit</a>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST"
                                            onsubmit="return confirm('Hapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn bg-error text-white">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-4 text-center text-bodytext">Belum ada data user.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
