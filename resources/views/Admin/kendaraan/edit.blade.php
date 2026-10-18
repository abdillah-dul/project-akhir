<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Kendaraan - DulAuto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="card shadow-sm mx-auto" style="max-width: 650px;">
        <div class="card-body p-4">
            <h3 class="mb-4">Edit Kendaraan DulAuto</h3>

            <form action="{{ route('kendaraan.update', $kendaraan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Kendaraan</label>
                    <input type="text" name="nama_kendaraan" class="form-control"
                        value="{{ old('nama_kendaraan', $kendaraan->nama_kendaraan) }}">
                    @error('nama_kendaraan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Merek</label>
                    <input type="text" name="merek" class="form-control"
                        value="{{ old('merek', $kendaraan->merek) }}">
                    @error('merek')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Tahun</label>
                    <input type="number" name="tahun" class="form-control"
                        value="{{ old('tahun', $kendaraan->tahun) }}">
                    @error('tahun')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga (Rp)</label>
                    <input type="number" name="harga" class="form-control"
                        value="{{ old('harga', $kendaraan->harga) }}">
                    @error('harga')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Kondisi</label>
                    <select name="kondisi" class="form-select">
                        <option value="">-- Pilih Kondisi --</option>
                        <option value="Bekas" {{ old('kondisi', $kendaraan->kondisi) == 'Bekas' ? 'selected' : '' }}>Bekas</option>
                        <option value="Sangat Baik" {{ old('kondisi', $kendaraan->kondisi) == 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
                    </select>
                    @error('kondisi')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
