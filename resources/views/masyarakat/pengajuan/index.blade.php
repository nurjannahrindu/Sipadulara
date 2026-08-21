<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pengajuan Saya - SIPADULARA</title>
</head>
<body>

    <h1>Pengajuan Saya</h1>

    <p>
        <a href="{{ route('masyarakat.dashboard') }}">
            ← Dashboard
        </a>
    </p>

    <p>
        <a href="{{ route('masyarakat.pengajuan.create') }}">
            + Buat Pengajuan
        </a>
    </p>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif

    @if ($pengajuans->count())

        <table border="1" cellpadding="10" cellspacing="0">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($pengajuans as $pengajuan)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $pengajuan->judul }}</td>

                        <td>
                            {{ $pengajuan->kategori->nama_kategori }}
                        </td>

                        <td>{{ $pengajuan->lokasi }}</td>

                        <td>
                            {{ $pengajuan->tanggal->format('d-m-Y') }}
                        </td>

                        <td>
                            {{ ucfirst($pengajuan->status) }}
                        </td>

                        <td>

                            <a href="{{ route('masyarakat.pengajuan.show', $pengajuan->id_pengajuan) }}">
                                Lihat
                            </a>

                            @if ($pengajuan->status === 'diajukan')

                                |

                                <a href="{{ route('masyarakat.pengajuan.edit', $pengajuan->id_pengajuan) }}">
                                    Edit
                                </a>

                                |

                                <form
                                    action="{{ route('masyarakat.pengajuan.destroy', $pengajuan->id_pengajuan) }}"
                                    method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('Yakin ingin menghapus pengajuan ini?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit">
                                        Hapus
                                    </button>
                                </form>

                            @endif

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    @else

        <p>Belum ada pengajuan.</p>

    @endif

</body>
</html>