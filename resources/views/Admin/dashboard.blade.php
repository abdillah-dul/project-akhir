@extends('Admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    @include('Admin.partials.page-heading', [
        'title' => 'Dashboard DulAuto',
        'description' => 'Kelola data showroom melalui satu ruang kerja.',
    ])

    @include('Admin.partials.feedback')

    <section class="relative flex flex-wrap items-center justify-between gap-6 rounded-lg bg-lightprimary p-6 mb-6">
        <div class="w-full">
            <p class="mb-2 text-sm font-semibold text-primary">Pusat operasional showroom</p>
            <h2 class="mb-2 text-2xl font-semibold text-dark">Selamat datang di DulAuto</h2>
            <p class="mb-0 text-sm text-bodytext">
                Akses pengelolaan pelanggan, barang, kendaraan, dan user tanpa meninggalkan dashboard.
            </p>
        </div>
        <a href="{{ route('kendaraan.index') }}" class="btn bg-primary text-white">Kelola kendaraan</a>
    </section>

    <section>
        <h2 class="mb-4 text-lg font-semibold text-dark dark:text-white">Menu pengelolaan</h2>
        <div class="grid grid-cols-2 gap-6">
            @foreach ([
                ['title' => 'Pelanggan', 'description' => 'Kelola profil dan informasi kontak pelanggan.', 'route' => 'pelanggan.index', 'label' => 'Buka data pelanggan', 'tone' => 'bg-lightprimary text-primary'],
                ['title' => 'Barang', 'description' => 'Atur daftar barang, kategori, harga, dan stok.', 'route' => 'barang.index', 'label' => 'Buka data barang', 'tone' => 'bg-lightwarning text-warning'],
                ['title' => 'Kendaraan', 'description' => 'Kelola katalog kendaraan yang tersedia di showroom.', 'route' => 'kendaraan.index', 'label' => 'Buka data kendaraan', 'tone' => 'bg-lightinfo text-info'],
                ['title' => 'User', 'description' => 'Kelola akun pengguna yang tercatat di aplikasi.', 'route' => 'users.index', 'label' => 'Buka data user', 'tone' => 'bg-lightsuccess text-success'],
            ] as $menu)
                <article class="card h-full">
                    <div class="card-body flex h-full flex-col">
                        <span class="mb-4 inline-flex w-fit rounded-full px-3 py-1 text-xs font-semibold {{ $menu['tone'] }}">
                            {{ $menu['title'] }}
                        </span>
                        <h3 class="card-title">{{ $menu['title'] }}</h3>
                        <p class="card-subtitle mb-4">{{ $menu['description'] }}</p>
                        <a href="{{ route($menu['route']) }}" class="btn btn-outline-primary">
                            {{ $menu['label'] }}
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endsection
