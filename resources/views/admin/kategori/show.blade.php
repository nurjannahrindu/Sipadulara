<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Kategori - SIPADULARA</title>
</head>
<body>

    <h1>Detail Kategori</h1>

    <p>
        <a
        href="{{ route('admin.pengajuan.index') }}"
        title="Kembali"
        class="back-button"
    >

        <svg
            width="26"
            height="26"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >

            <path
                d="M15 18L9 12L15 6"
                stroke="currentColor"
                stroke-width="2.5"
                stroke-linecap="round"
                stroke-linejoin="round"
            />

        </svg>

    </a>

    </p>>

    <p>
        <strong>ID:</strong>
        {{ $kategori->id_kategori }}
    </p>

    <p>
        <strong>Nama Kategori:</strong>
        {{ $kategori->nama_kategori }}
    </p>

    <p>
        <strong>Keterangan:</strong>
        {{ $kategori->keterangan ?? '-' }}
    </p>

    <p>
        <strong>Dibuat:</strong>
        {{ $kategori->created_at->format('d-m-Y H:i') }}
    </p>

    <p>
        <strong>Diperbarui:</strong>
        {{ $kategori->updated_at->format('d-m-Y H:i') }}
    </p>

    <p>
        <a href="{{ route('admin.kategori.edit', $kategori->id_kategori) }}">
            Edit Kategori
        </a>
    </p>

</body>
</html>