@extends('Admin.layouts.app')

@section('title', 'Edit User')

@section('content')
    @include('Admin.partials.page-heading', [
        'title' => 'Edit User',
        'description' => 'Perbarui informasi akun pengguna.',
    ])
    @include('Admin.partials.feedback')

    <section class="card">
        <div class="card-body">
            @include('Admin.user._form', [
                'user' => $user,
                'formAction' => route('users.update', $user),
            ])
        </div>
    </section>
@endsection
