<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Penanganan Pengajuan - SIPADULARA</title>
</head>
<body>

    @if (session('success'))
        <p>
            <strong>{{ session('success') }}</strong>
        </p>
    @endif

    @if (session('error'))
        <p>
            <strong>{{ session('error') }}</strong>
        </p>
    @endif

    <h1>Penanganan Pengajuan</h1>

    <p>
        <a href="{{ route('admin.pengajuan.show', $pengajuan->id_pengajuan) }}">
            ← Kembali
        </a>
    </p>

    <hr>

    <h3>Data Pengajuan</h3>

    <p>
        <strong>Masyarakat:</strong>
        {{ $pengajuan->masyarakat->nama }}
    </p>

    <p>
        <strong>Kategori:</strong>
        {{ $pengajuan->kategori->nama_kategori }}
    </p>

    <p>
        <strong>Judul:</strong>
        {{ $pengajuan->judul }}
    </p>

    <p>
        <strong>Lokasi:</strong>
        {{ $pengajuan->lokasi }}
    </p>

    <hr>

    @if ($errors->any())

        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>

    @endif

    <form
        action="{{ route('admin.penanganan.store', $pengajuan->id_pengajuan) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        <div>
            <label>Status Penanganan</label>
            <br>

            <select name="status" required>

                <option value="">
                    -- Pilih Status --
                </option>

                <option value="diproses">
                    Diproses
                </option>

                <option value="ditangani">
                    Ditangani
                </option>

                <option value="selesai">
                    Selesai
                </option>

                <option value="ditolak">
                    Ditolak
                </option>

            </select>
        </div>

        <br>

        <div>
            <label>Tanggal Penanganan</label>
            <br>

            <input
                type="date"
                name="tanggal_penanganan"
                value="{{ old('tanggal_penanganan', date('Y-m-d')) }}"
                required
            >
        </div>

        <br>

        <div>
            <label>Keterangan Penanganan</label>
            <br>

            <textarea
                name="keterangan"
                rows="6"
                placeholder="Tuliskan tindakan atau hasil penanganan..."
            >{{ old('keterangan') }}</textarea>
        </div>

        <br>

        <div>
            <label>Foto Penanganan</label>
            <br>

            <input
                type="file"
                name="gambar"
                accept="image/*"
            >

            <small>
                JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
            </small>
        </div>

        <br>

        <button type="submit">
            Simpan Penanganan
        </button>

    </form>

</body>
</html>