@extends('Admin.layouts.app')

@section('title', 'Edit Layanan Servis')

@section('content')
    @include('Admin.partials.page-heading', [
        'title' => 'Edit Layanan Servis',
        'description' => 'Perbarui informasi layanan servis.',
    ])
    @include('Admin.partials.feedback')

    <section class="card">
        <div class="card-body">
            <form action="{{ route('layanan.update', $layanan) }}" method="POST">
                @csrf
                @method('PUT')
                @include('Admin.layanan._form')
                <div class="mt-6 flex flex-wrap gap-3">
                    <button type="submit" class="btn bg-primary text-white">Simpan Perubahan</button>
                    <a href="{{ route('layanan.index') }}" class="btn btn-outline-primary">Batal</a>
                </div>
            </form>
        </div>
    </section>
@endsection
