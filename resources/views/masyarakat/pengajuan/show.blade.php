@extends('layouts.masyarakat')

@section('title', 'Detail Pengajuan - SIPADULARA')

@section('styles')

    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    >

    <style>
        /* CSS KHUSUS DETAIL PENGAJUAN SAJA */
        
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .detail-item {
            background: #f8fafc;
            padding: 18px;
            border-radius: 12px;
        }

        .detail-item.full {
            grid-column: 1 / -1;
        }

        .label {
            display: block;
            color: #64748b;
            font-size: 14px;
            margin-bottom: 7px;
            font-weight: bold;
        }

        .value {
            font-size: 17px;
            line-height: 1.5;
        }

        .status {
            display: inline-block;
            padding: 7px 14px;
            border-radius: 9px;
            font-weight: bold;
        }

        .status-diajukan {
            background: #fef3c7;
            color: #92400e;
        }

        .status-diproses {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-selesai {
            background: #dcfce7;
            color: #166534;
        }

        .status-ditolak {
            background: #fee2e2;
            color: #991b1b;
        }

        #map {
            height: 400px;
            width: 100%;
            border-radius: 14px;
            margin-top: 15px;
            border: 1px solid #e5e7eb;
        }

        .gambar {
            max-width: 600px;
            width: 100%;
            border-radius: 14px;
            margin-top: 10px;
            display: block;
        }

        .riwayat {
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 15px;
            background: #fafafa;
        }

        .riwayat:last-child {
            margin-bottom: 0;
        }

        @media (max-width: 750px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }

            .detail-item.full {
                grid-column: auto;
            }
        }
    </style>

@endsection


@section('content')

    {{-- HEADER HALAMAN --}}

    <div class="page-header">

        <div>

            <h1 class="page-title">
                Detail Pengajuan
            </h1>

            <p class="page-description">
                Informasi lengkap mengenai pengajuan kamu.
            </p>

        </div>

        <a
            href="{{ route('masyarakat.pengajuan.index') }}"
            title="Kembali"
            style="
                width: 48px;
                height: 48px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border-radius: 50%;
                background: #1e3a8a;
                color: white;
                text-decoration: none;
                font-size: 32px;
                font-weight: 500;
                line-height: 1;
                box-shadow: 0 3px 8px rgba(0,0,0,.20);
                transition: all .2s ease;
                flex-shrink: 0;
            "
        >
            ‹
        </a>

    </div>


    {{-- SUCCESS --}}

    @if (session('success'))

        <div class="alert alert-success">
            ✓ {{ session('success') }}
        </div>

    @endif


    {{-- ERROR --}}

    @if (session('error'))

        <div class="alert alert-error">
            ⚠ {{ session('error') }}
        </div>

    @endif


    {{-- =====================================================
         DATA PENGAJUAN
         ISINYA TETAP PUNYA KAMU
    ====================================================== --}}

    <div class="card">

        <h2>
             Data Pengajuan
        </h2>

        <div class="detail-grid">

            {{-- Kategori --}}
            <div class="detail-item">

                <span class="label">
                    Kategori
                </span>

                <div class="value">
                    {{ $pengajuan->kategori->nama_kategori ?? '-' }}
                </div>

            </div>


            {{-- Tanggal --}}
            <div class="detail-item">

                <span class="label">
                    Tanggal Pengajuan
                </span>

                <div class="value">
                    {{ $pengajuan->tanggal->format('d-m-Y') }}
                </div>

            </div>


            {{-- Judul --}}
            <div class="detail-item full">

                <span class="label">
                    Judul
                </span>

                <div class="value">
                    {{ $pengajuan->judul }}
                </div>

            </div>


            {{-- Keterangan --}}
            <div class="detail-item full">

                <span class="label">
                    Keterangan
                </span>

                <div class="value">
                    {{ $pengajuan->keterangan ?: '-' }}
                </div>

            </div>


            {{-- Lokasi --}}
            <div class="detail-item full">

                <span class="label">
                    Lokasi
                </span>

                <div class="value">
                    {{ $pengajuan->lokasi ?: '-' }}
                </div>

            </div>


            {{-- Status --}}
            <div class="detail-item">

                <span class="label">
                    Status Saat Ini
                </span>

                <div class="value">

                    @if ($pengajuan->status === 'diajukan')

                        <span class="status status-diajukan">
                            Diajukan
                        </span>

                    @elseif ($pengajuan->status === 'diproses')

                        <span class="status status-diproses">
                            Diproses
                        </span>

                    @elseif ($pengajuan->status === 'selesai')

                        <span class="status status-selesai">
                            Selesai
                        </span>

                    @elseif ($pengajuan->status === 'ditolak')

                        <span class="status status-ditolak">
                            Ditolak
                        </span>

                    @else

                        <span class="status">
                            {{ ucfirst($pengajuan->status) }}
                        </span>

                    @endif

                </div>

            </div>

        </div>


        {{-- GAMBAR --}}

        @if ($pengajuan->gambar)

            <div style="margin-top:25px;">

                <span class="label">
                    Gambar Pengajuan
                </span>

                <img
                    class="gambar"
                    src="{{ asset('storage/' . $pengajuan->gambar) }}"
                    alt="Gambar Pengajuan"
                >

            </div>

        @endif


        {{-- MAP --}}

        @if (str_contains($pengajuan->lokasi ?? '', 'Latitude:'))

            <div style="margin-top:25px;">

                <span class="label">
                    📍 Lokasi pada Peta
                </span>

                <div id="map"></div>

            </div>

        @endif

    </div>


    {{-- =====================================================
         RIWAYAT PENANGANAN
         ISINYA TETAP PUNYA KAMU
    ====================================================== --}}

    <div class="card">

        <h2>
            Riwayat Penanganan
        </h2>

        @if ($pengajuan->penanganans->count())

            @foreach ($pengajuan->penanganans as $penanganan)

                <div class="riwayat">

                    <div style="margin-bottom:15px;">

                        <span class="label">
                            Status
                        </span>

                        @if ($penanganan->status === 'diproses')

                            <span class="status status-diproses">
                                Diproses
                            </span>

                        @elseif ($penanganan->status === 'selesai')

                            <span class="status status-selesai">
                                Selesai
                            </span>

                        @elseif ($penanganan->status === 'ditolak')

                            <span class="status status-ditolak">
                                Ditolak
                            </span>

                        @else

                            <span class="status">
                                {{ ucfirst($penanganan->status) }}
                            </span>

                        @endif

                    </div>


                    <div style="margin-bottom:15px;">

                        <span class="label">
                            Tanggal Penanganan
                        </span>

                        <div class="value">
                            {{ $penanganan->tanggal_penanganan->format('d-m-Y') }}
                        </div>

                    </div>


                    <div style="margin-bottom:15px;">

                        <span class="label">
                            Keterangan
                        </span>

                        <div class="value">
                            {{ $penanganan->keterangan ?: '-' }}
                        </div>

                    </div>


                    @if ($penanganan->gambar)

                        <div>

                            <span class="label">
                                Foto Penanganan
                            </span>

                            <img
                                class="gambar"
                                src="{{ asset('storage/' . $penanganan->gambar) }}"
                                alt="Foto Penanganan"
                            >

                        </div>

                    @endif

                </div>

            @endforeach

        @else

            <div
                style="
                    padding:25px;
                    background:#f8fafc;
                    border-radius:12px;
                    color:#64748b;
                "
            >
                Belum ada penanganan dari admin.
            </div>

        @endif

    </div>

@endsection


@section('scripts')

    @if (str_contains($pengajuan->lokasi ?? '', 'Latitude:'))

        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

        <script>

            const lokasi = @json($pengajuan->lokasi);

            const match = lokasi.match(
                /Latitude:\s*([-0-9.]+),\s*Longitude:\s*([-0-9.]+)/
            );

            if (match) {

                const latitude = parseFloat(match[1]);
                const longitude = parseFloat(match[2]);

                const map = L.map('map').setView(
                    [latitude, longitude],
                    17
                );

                L.tileLayer(
                    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                    {
                        maxZoom: 19,
                        attribution: '&copy; OpenStreetMap contributors'
                    }
                ).addTo(map);

                L.marker([
                    latitude,
                    longitude
                ])
                .addTo(map)
                .bindPopup(
                    '<strong>Lokasi Pengaduan</strong><br>' +
                    'Latitude: ' + latitude + '<br>' +
                    'Longitude: ' + longitude
                )
                .openPopup();

            }

        </script>

    @endif

@endsection