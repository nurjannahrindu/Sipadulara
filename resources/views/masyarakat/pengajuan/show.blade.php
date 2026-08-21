<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Detail Pengajuan - SIPADULARA</title>


    {{-- Leaflet CSS --}}
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    >


    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background: #f5f5f5;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        .card {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
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

        .status-ditangani {
            background: #e0e7ff;
            color: #3730a3;
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
            margin-top: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .gambar {
            max-width: 500px;
            width: 100%;
            border-radius: 8px;
            margin-top: 10px;
        }

        .riwayat {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
        }

    </style>

</head>


<body>

<div class="container">


    {{-- PESAN SUCCESS --}}
    @if (session('success'))

        <div class="card">

            <strong>
                {{ session('success') }}
            </strong>

        </div>

    @endif


    {{-- PESAN ERROR --}}
    @if (session('error'))

        <div class="card">

            <strong>
                {{ session('error') }}
            </strong>

        </div>

    @endif


    {{-- JUDUL --}}
    <h1>
        Detail Pengajuan
    </h1>


    {{-- KEMBALI --}}
    <a
        class="back"
        href="{{ route('masyarakat.pengajuan.index') }}"
    >
        ← Kembali ke Pengajuan Saya
    </a>


    {{-- ============================= --}}
    {{-- DATA PENGAJUAN --}}
    {{-- ============================= --}}

    <div class="card">

        <h2>
            Data Pengajuan
        </h2>


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


        {{-- LOKASI --}}
        <p>

            <strong>Lokasi:</strong><br>

            {{ $pengajuan->lokasi }}

        </p>


        {{-- ============================= --}}
        {{-- MAPS --}}
        {{-- ============================= --}}

        @if (str_contains($pengajuan->lokasi, 'Latitude:'))

            <strong>
                Lokasi pada Peta:
            </strong>

            <div id="map"></div>

        @endif


        <p>

            <strong>Tanggal Pengajuan:</strong><br>

            {{ $pengajuan->tanggal->format('d-m-Y') }}

        </p>


        {{-- STATUS --}}
        <p>

            <strong>Status Saat Ini:</strong><br>


            @if ($pengajuan->status === 'diajukan')

                <span class="status status-diajukan">
                    Diajukan
                </span>

            @elseif ($pengajuan->status === 'diproses')

                <span class="status status-diproses">
                    Diproses
                </span>

            @elseif ($pengajuan->status === 'ditangani')

                <span class="status status-ditangani">
                    Ditangani
                </span>

            @elseif ($pengajuan->status === 'selesai')

                <span class="status status-selesai">
                    Selesai
                </span>

            @elseif ($pengajuan->status === 'ditolak')

                <span class="status status-ditolak">
                    Ditolak
                </span>

            @endif

        </p>


        {{-- GAMBAR PENGAJUAN --}}
        @if ($pengajuan->gambar)

            <p>

                <strong>
                    Gambar Pengajuan:
                </strong>

            </p>


            <img
                class="gambar"
                src="{{ asset('storage/' . $pengajuan->gambar) }}"
                alt="Gambar Pengajuan"
            >

        @endif

    </div>


    {{-- ============================= --}}
    {{-- RIWAYAT PENANGANAN --}}
    {{-- ============================= --}}

    <div class="card">

        <h2>
            Riwayat Penanganan
        </h2>


        @if ($pengajuan->penanganans->count())


            @foreach ($pengajuan->penanganans as $penanganan)

                <div class="riwayat">


                    {{-- STATUS --}}
                    <p>

                        <strong>
                            Status:
                        </strong>

                        <br>


                        @if ($penanganan->status === 'diproses')

                            <span class="status status-diproses">
                                Diproses
                            </span>

                        @elseif ($penanganan->status === 'ditangani')

                            <span class="status status-ditangani">
                                Ditangani
                            </span>

                        @elseif ($penanganan->status === 'selesai')

                            <span class="status status-selesai">
                                Selesai
                            </span>

                        @elseif ($penanganan->status === 'ditolak')

                            <span class="status status-ditolak">
                                Ditolak
                            </span>

                        @endif

                    </p>


                    {{-- TANGGAL --}}
                    <p>

                        <strong>
                            Tanggal Penanganan:
                        </strong>

                        <br>

                        {{ $penanganan->tanggal_penanganan->format('d-m-Y') }}

                    </p>


                    {{-- KETERANGAN --}}
                    <p>

                        <strong>
                            Keterangan:
                        </strong>

                        <br>

                        {{ $penanganan->keterangan ?? '-' }}

                    </p>


                    {{-- FOTO PENANGANAN --}}
                    @if ($penanganan->gambar)

                        <p>

                            <strong>
                                Foto Penanganan:
                            </strong>

                        </p>


                        <img
                            class="gambar"
                            src="{{ asset('storage/' . $penanganan->gambar) }}"
                            alt="Foto Penanganan"
                        >

                    @endif


                </div>

            @endforeach


        @else

            <p>
                Belum ada penanganan dari admin.
            </p>

        @endif

    </div>

</div>


{{-- ============================= --}}
{{-- LEAFLET JAVASCRIPT --}}
{{-- ============================= --}}

@if (str_contains($pengajuan->lokasi, 'Latitude:'))

    <script
        src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    ></script>


    <script>

        // Ambil lokasi dari database
        const lokasi = @json($pengajuan->lokasi);


        // Membaca Latitude dan Longitude
        const match = lokasi.match(
            /Latitude:\s*([-0-9.]+),\s*Longitude:\s*([-0-9.]+)/
        );


        if (match) {

            const latitude = parseFloat(match[1]);

            const longitude = parseFloat(match[2]);


            // Membuat peta
            const map = L.map('map').setView(
                [latitude, longitude],
                17
            );


            // OpenStreetMap
            L.tileLayer(
                'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                {
                    maxZoom: 19,

                    attribution:
                        '&copy; OpenStreetMap contributors'
                }
            ).addTo(map);


            // Marker lokasi pengaduan
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


</body>
</html>