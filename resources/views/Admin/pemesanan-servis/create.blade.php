@extends('Admin.layouts.app')

@section('title', 'Tambah Pemesanan Servis')

@section('content')
    @include('Admin.partials.page-heading', [
        'title' => 'Tambah Pemesanan Servis',
        'description' => 'Catat jadwal servis untuk pelanggan dan kendaraan.',
    ])
    @include('Admin.partials.feedback')

    <section class="card">
        <div class="card-body">
            <form action="{{ route('pemesanan-servis.store') }}" method="POST">
                @csrf
                @include('Admin.pemesanan-servis._form')
                <div class="mt-6 flex flex-wrap gap-3">
                    <button type="submit" class="btn bg-primary text-white">Simpan Pemesanan</button>
                    <a href="{{ route('pemesanan-servis.index') }}" class="btn btn-outline-primary">Batal</a>
                </div>
            </form>
        </div>
    </section>
@endsection
