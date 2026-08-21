<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Penanganan Pengajuan - SIPADULARA</title>
</head>

<body>

    <h1>Penanganan Pengajuan</h1>

    <p>
        <a href="{{ route('admin.pengajuan.show', $pengajuan->id_pengajuan) }}">
            ← Kembali
        </a>
    </p>

    <hr>

    <h3>Data Pengajuan</h3>

    <p>
        <strong>Masyarakat:</strong><br>
        {{ $pengajuan->masyarakat->nama }}
    </p>

    <p>
        <strong>Kategori:</strong><br>
        {{ $pengajuan->kategori->nama_kategori }}
    </p>

    <p>
        <strong>Judul:</strong><br>
        {{ $pengajuan->judul }}
    </p>

    <p>
        <strong>Keterangan:</strong><br>
        {{ $pengajuan->keterangan }}
    </p>

    <p>
        <strong>Lokasi:</strong><br>
        {{ $pengajuan->lokasi }}
    </p>

    <p>
        <strong>Status Saat Ini:</strong><br>
        {{ ucfirst($pengajuan->status) }}
    </p>

    @if ($pengajuan->gambar)

        <p>
            <strong>Gambar Pengajuan:</strong>
        </p>

        <img
            src="{{ asset('storage/' . $pengajuan->gambar) }}"
            alt="Gambar Pengajuan"
            width="400"
        >

    @endif

    <hr>

    <h3>Form Penanganan</h3>

    @if ($errors->any())

        <div>

            <strong>Terjadi kesalahan:</strong>

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
            <label for="status">
                Status Penanganan
            </label>

            <br>

            <select name="status" id="status" required>

                <option value="">
                    -- Pilih Status --
                </option>

                <option
                    value="diproses"
                    {{ old('status') == 'diproses' ? 'selected' : '' }}
                >
                    Diproses
                </option>

                <option
                    value="ditangani"
                    {{ old('status') == 'ditangani' ? 'selected' : '' }}
                >
                    Ditangani
                </option>

                <option
                    value="selesai"
                    {{ old('status') == 'selesai' ? 'selected' : '' }}
                >
                    Selesai
                </option>

                <option
                    value="ditolak"
                    {{ old('status') == 'ditolak' ? 'selected' : '' }}
                >
                    Ditolak
                </option>

            </select>
        </div>

        <br>

        <div>
            <label for="tanggal_penanganan">
                Tanggal Penanganan
            </label>

            <br>

            <input
                type="date"
                name="tanggal_penanganan"
                id="tanggal_penanganan"
                value="{{ old('tanggal_penanganan', date('Y-m-d')) }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="keterangan">
                Keterangan Penanganan
            </label>

            <br>

            <textarea
                name="keterangan"
                id="keterangan"
                rows="6"
                placeholder="Tuliskan tindakan atau hasil penanganan..."
            >{{ old('keterangan') }}</textarea>
        </div>

        <br>

        <div>
            <label for="gambar">
                Foto Penanganan
            </label>

            <br>

            <input
                type="file"
                name="gambar"
                id="gambar"
                accept="image/*"
            >

            <br>

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