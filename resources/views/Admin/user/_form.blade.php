@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ $formAction }}" method="POST"
      class="bg-white border rounded p-4 mt-3">
    @csrf
    @if ($user !== null)
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" id="name" name="name" class="form-control"
               value="{{ old('name', $user?->name) }}" maxlength="255" required>
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" class="form-control"
               value="{{ old('email', $user?->email) }}" maxlength="255" required>
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" name="password" class="form-control"
               minlength="8" maxlength="255" @required($user === null)>
        @if ($user !== null)
            <div class="form-text">Kosongkan jika tidak ingin mengubah password.</div>
        @endif
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">
        {{ $user === null ? 'Simpan' : 'Simpan Perubahan' }}
    </button>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
</form>
