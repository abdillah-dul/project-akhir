@if (session('success'))
    <div class="rounded-lg bg-lightsuccess p-4 text-success mb-4" role="status">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="rounded-lg bg-lighterror p-4 text-error mb-4" role="alert">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="rounded-lg bg-lighterror p-4 text-error mb-4" role="alert">
        <p class="mb-2 font-semibold">Data gagal diproses. Periksa kembali isian berikut:</p>
        <ul class="mb-0 list-disc ps-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
