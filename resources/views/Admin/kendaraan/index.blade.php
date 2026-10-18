
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Kendaraan - DulAuto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4">Data Kendaraan DulAuto</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            Data gagal diproses. Periksa kembali isian form.
        </div>
    @endif

    <a href="{{ route('kendaraan.create') }}" class="btn btn-primary mb-3">
        + Tambah Kendaraan
    </a>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-bordered table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Kendaraan</th>
                        <th>Merek</th>
                        <th>Tahun</th>
                        <th>Harga</th>
                        <th>Kondisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kendaraan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_kendaraan }}</td>
                            <td>{{ $item->merek }}</td>
                            <td>{{ $item->tahun }}</td>
                            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>{{ $item->kondisi }}</td>
                            <td>
                                <a href="{{ route('kendaraan.edit', $item->id) }}"
                                   class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('kendaraan.destroy', $item->id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                Belum ada data kendaraan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <a href="/admin" class="btn btn-secondary mt-3">Kembali ke Dashboard</a>
</div>
</body>
</html>
