@extends('Admin.layouts.app')

@section('title', 'Tambah User')

@section('content')
    @include('Admin.partials.page-heading', [
        'title' => 'Tambah User',
        'description' => 'Buat akun pengguna aplikasi.',
    ])
    @include('Admin.partials.feedback')

    <section class="card">
        <div class="card-body">
            @include('Admin.user._form', [
                'user' => null,
                'formAction' => route('users.store'),
            ])
        </div>
    </section>
@endsection
