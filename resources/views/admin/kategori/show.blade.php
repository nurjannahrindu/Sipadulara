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
        <a href="{{ route('admin.kategori.index') }}">
            ← Kembali
        </a>
    </p>

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