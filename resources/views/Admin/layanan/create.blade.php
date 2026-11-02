@extends('Admin.layouts.app')

@section('title', 'Tambah Layanan Servis')

@section('content')
    @include('Admin.partials.page-heading', [
        'title' => 'Tambah Layanan Servis',
        'description' => 'Tambahkan layanan yang dapat dipilih untuk pemesanan servis.',
    ])
    @include('Admin.partials.feedback')

    <section class="card">
        <div class="card-body">
            <form action="{{ route('layanan.store') }}" method="POST">
                @csrf
                @include('Admin.layanan._form')
                <div class="mt-6 flex flex-wrap gap-3">
                    <button type="submit" class="btn bg-primary text-white">Simpan Layanan</button>
                    <a href="{{ route('layanan.index') }}" class="btn btn-outline-primary">Batal</a>
                </div>
            </form>
        </div>
    </section>
@endsection
