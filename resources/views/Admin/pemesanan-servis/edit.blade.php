@extends('Admin.layouts.app')

@section('title', 'Edit Pemesanan Servis')

@section('content')
    @include('Admin.partials.page-heading', [
        'title' => 'Edit Pemesanan Servis',
        'description' => 'Perbarui jadwal atau status pemesanan servis.',
    ])
    @include('Admin.partials.feedback')

    <section class="card">
        <div class="card-body">
            <form action="{{ route('pemesanan-servis.update', $pemesananServis->id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('Admin.pemesanan-servis._form')
                <div class="mt-6 flex flex-wrap gap-3">
                    <button type="submit" class="btn bg-primary text-white">Simpan Perubahan</button>
                    <a href="{{ route('pemesanan-servis.index') }}" class="btn btn-outline-primary">Batal</a>
                </div>
            </form>
        </div>
    </section>
@endsection
