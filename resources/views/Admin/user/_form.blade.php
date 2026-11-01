<form action="{{ $formAction }}" method="POST"
      >
    @csrf
    @if ($user !== null)
        @method('PUT')
    @endif

    <div class="mb-4">
        <label for="name" class="mb-2 block font-medium">Nama</label>
        <input type="text" id="name" name="name" class="form-control"
               value="{{ old('name', $user?->name) }}" maxlength="255" required>
        @error('name')
            <p class="text-xs text-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="email" class="mb-2 block font-medium">Email</label>
        <input type="email" id="email" name="email" class="form-control"
               value="{{ old('email', $user?->email) }}" maxlength="255" required>
        @error('email')
            <p class="text-xs text-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="password" class="mb-2 block font-medium">Password</label>
        <input type="password" id="password" name="password" class="form-control"
               minlength="8" maxlength="255" @required($user === null)>
        @if ($user !== null)
            <p class="text-xs text-bodytext">Kosongkan jika tidak ingin mengubah password.</p>
        @endif
        @error('password')
            <p class="text-xs text-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex flex-wrap gap-3">
        <button type="submit" class="btn bg-primary text-white">
            {{ $user === null ? 'Simpan' : 'Simpan Perubahan' }}
        </button>
        <a href="{{ route('users.index') }}" class="btn btn-outline-primary">Batal</a>
    </div>
</form>
