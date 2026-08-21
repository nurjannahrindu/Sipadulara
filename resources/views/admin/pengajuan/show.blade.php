@extends('layouts.admin')

@section('title', 'Detail Pengajuan')

@section('content')

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">

        <div>
            <h1 style="margin: 0;">Detail Pengajuan</h1>

            <p style="color: #6b7280;">
                Informasi lengkap pengajuan masyarakat.
            </p>
        </div>

        <a
            href="{{ route('admin.pengajuan.index') }}"
            class="btn"
            style="background: #6b7280; color: white;"
        >
            ← Kembali
        </a>

    </div>


    {{-- PESAN SUCCESS --}}

    @if (session('success'))

        <div
            class="card"
            style="margin-bottom: 20px; border-left: 5px solid #16a34a;"
        >

            <strong style="color: #166534;">
                {{ session('success') }}
            </strong>

        </div>

    @endif


    {{-- DETAIL PENGAJUAN --}}

    <div class="card" style="margin-bottom: 20px;">

        <h2>Informasi Pengajuan</h2>

        <table>

            <tr>
                <th style="width: 200px;">Masyarakat</th>

                <td>
                    {{ $pengajuan->masyarakat->nama }}
                </td>
            </tr>

            <tr>
                <th>Kategori</th>

                <td>
                    {{ $pengajuan->kategori->nama_kategori }}
                </td>
            </tr>

            <tr>
                <th>Judul</th>

                <td>
                    {{ $pengajuan->judul }}
                </td>
            </tr>

            <tr>
                <th>Keterangan</th>

                <td>
                    {{ $pengajuan->keterangan }}
                </td>
            </tr>

            <tr>
                <th>Lokasi</th>

                <td>
                    {{ $pengajuan->lokasi }}

                    @php
                        preg_match(
                            '/Latitude:\s*(-?\d+(?:\.\d+)?),\s*Longitude:\s*(-?\d+(?:\.\d+)?)/i',
                            $pengajuan->lokasi,
                            $koordinat
                        );

                        $latitude = $koordinat[1] ?? null;
                        $longitude = $koordinat[2] ?? null;
                    @endphp

                    @if ($latitude && $longitude)

                        <div style="margin-top: 15px;">

                            <strong>Lokasi pada Peta:</strong>

                            <div
                                style="
                                    margin-top: 10px;
                                    border-radius: 10px;
                                    overflow: hidden;
                                    border: 1px solid #ddd;
                                "
                            >

                                <iframe
                                    width="100%"
                                    height="350"
                                    style="border:0;"
                                    loading="lazy"
                                    allowfullscreen
                                    src="https://www.google.com/maps?q={{ $latitude }},{{ $longitude }}&output=embed"
                                >
                                </iframe>

                            </div>

                            <p style="margin-top: 10px;">

                                <a
                                    href="https://www.google.com/maps?q={{ $latitude }},{{ $longitude }}"
                                    target="_blank"
                                    class="btn btn-primary"
                                >
                                    📍 Buka di Google Maps
                                </a>

                            </p>

                        </div>

                    @endif

                </td>
            </tr>
            <tr>
                <th>Tanggal Pengajuan</th>

                <td>
                    {{ $pengajuan->tanggal->format('d-m-Y') }}
                </td>
            </tr>

            <tr>
                <th>Status</th>

                <td>

                    @if ($pengajuan->status === 'diajukan')

                        <span style="background:#fef3c7;color:#92400e;padding:6px 12px;border-radius:20px;">
                            Diajukan
                        </span>

                    @elseif ($pengajuan->status === 'diproses')

                        <span style="background:#dbeafe;color:#1e40af;padding:6px 12px;border-radius:20px;">
                            Diproses
                        </span>

                    @elseif ($pengajuan->status === 'ditangani')

                        <span style="background:#e0e7ff;color:#3730a3;padding:6px 12px;border-radius:20px;">
                            Ditangani
                        </span>

                    @elseif ($pengajuan->status === 'selesai')

                        <span style="background:#dcfce7;color:#166534;padding:6px 12px;border-radius:20px;">
                            Selesai
                        </span>

                    @elseif ($pengajuan->status === 'ditolak')

                        <span style="background:#fee2e2;color:#991b1b;padding:6px 12px;border-radius:20px;">
                            Ditolak
                        </span>

                    @endif

                </td>

            </tr>

        </table>

    </div>


    {{-- GAMBAR PENGAJUAN --}}

    @if ($pengajuan->gambar)

        <div class="card" style="margin-bottom: 20px;">

            <h2>Gambar Pengajuan</h2>

            <img
                src="{{ asset('storage/' . $pengajuan->gambar) }}"
                alt="Gambar Pengajuan"
                style="
                    max-width: 500px;
                    width: 100%;
                    border-radius: 10px;
                    margin-top: 10px;
                "
            >

        </div>

    @endif


    {{-- TOMBOL PENANGANAN --}}

    @if (
        $pengajuan->status !== 'selesai' &&
        $pengajuan->status !== 'ditolak'
    )

        <div class="card" style="margin-bottom: 20px;">

            <h2>Penanganan</h2>

            <p>
                Pengajuan ini masih dapat ditangani oleh admin.
            </p>

            <a
                href="{{ route('admin.penanganan.create', $pengajuan->id_pengajuan) }}"
                class="btn btn-primary"
            >
                Tangani Pengajuan
            </a>

        </div>

    @endif


    {{-- RIWAYAT PENANGANAN --}}

    <div class="card">

        <h2>Riwayat Penanganan</h2>

        @if ($pengajuan->penanganans->count() > 0)

            @foreach ($pengajuan->penanganans as $penanganan)

                <div
                    style="
                        border: 1px solid #e5e7eb;
                        border-radius: 8px;
                        padding: 20px;
                        margin-bottom: 15px;
                    "
                >

                    <p>
                        <strong>Status:</strong>

                        @if ($penanganan->status === 'diproses')

                            <span style="background:#dbeafe;color:#1e40af;padding:5px 10px;border-radius:20px;">
                                Diproses
                            </span>

                        @elseif ($penanganan->status === 'ditangani')

                            <span style="background:#e0e7ff;color:#3730a3;padding:5px 10px;border-radius:20px;">
                                Ditangani
                            </span>

                        @elseif ($penanganan->status === 'selesai')

                            <span style="background:#dcfce7;color:#166534;padding:5px 10px;border-radius:20px;">
                                Selesai
                            </span>

                        @elseif ($penanganan->status === 'ditolak')

                            <span style="background:#fee2e2;color:#991b1b;padding:5px 10px;border-radius:20px;">
                                Ditolak
                            </span>

                        @endif

                    </p>

                    <p>
                        <strong>Tanggal Penanganan:</strong><br>

                        {{ $penanganan->tanggal_penanganan->format('d-m-Y') }}
                    </p>

                    <p>
                        <strong>Admin:</strong><br>

                        {{ $penanganan->admin->nama ?? '-' }}
                    </p>

                    <p>
                        <strong>Keterangan:</strong><br>

                        {{ $penanganan->keterangan ?? '-' }}
                    </p>


                    @if ($penanganan->gambar)

                        <p>
                            <strong>Foto Penanganan:</strong>
                        </p>

                        <img
                            src="{{ asset('storage/' . $penanganan->gambar) }}"
                            alt="Foto Penanganan"
                            style="
                                max-width: 400px;
                                width: 100%;
                                border-radius: 8px;
                            "
                        >

                    @endif


                    <p style="margin-top: 15px;">

                        <a
                            href="{{ route('admin.penanganan.edit', $penanganan->id_penanganan) }}"
                            class="btn"
                            style="background:#f59e0b;color:white;"
                        >
                            Edit Penanganan
                        </a>

                    </p>

                </div>

            @endforeach

        @else

            <p>
                Belum ada penanganan untuk pengajuan ini.
            </p>

        @endif

    </div>

@endsection