<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Buat Pengajuan - SIPADULARA</title>

    {{-- Leaflet CSS --}}
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    />

    <style>
        #map {
            height: 400px;
            width: 100%;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .map-info {
            margin-top: 8px;
            padding: 10px;
            background: #f3f4f6;
            border-radius: 6px;
        }

        .location-button {
            margin-top: 10px;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            background: #2563eb;
            color: white;
        }

        .location-button:hover {
            background: #1d4ed8;
        }

        .location-help {
            color: #666;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <h1>Buat Pengajuan</h1>

    <p>
        <a href="{{ route('masyarakat.pengajuan.index') }}">
            ← Kembali
        </a>
    </p>

    @if ($errors->any())

        <div>

            @foreach ($errors->all() as $error)

                <p>{{ $error }}</p>

            @endforeach

        </div>

    @endif


    <form
        action="{{ route('masyarakat.pengajuan.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        {{-- KATEGORI --}}
        <div>

            <label>
                Kategori
            </label>

            <br>

            <select name="id_kategori" required>

                <option value="">
                    -- Pilih Kategori --
                </option>

                @foreach ($kategoris as $kategori)

                    <option
                        value="{{ $kategori->id_kategori }}"
                        {{ old('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}
                    >
                        {{ $kategori->nama_kategori }}
                    </option>

                @endforeach

            </select>

        </div>

        <br>


        {{-- JUDUL --}}
        <div>

            <label>
                Judul Pengajuan
            </label>

            <br>

            <input
                type="text"
                name="judul"
                value="{{ old('judul') }}"
                required
            >

        </div>

        <br>


        {{-- KETERANGAN --}}
        <div>

            <label>
                Keterangan
            </label>

            <br>

            <textarea
                name="keterangan"
                rows="6"
                required
            >{{ old('keterangan') }}</textarea>

        </div>

        <br>


        {{-- LOKASI --}}
        <div>

            <label>
                <strong>Lokasi Pengaduan</strong>
            </label>

            <p class="location-help">
                Klik titik pada peta untuk menentukan lokasi pengaduan.
                Kamu juga bisa menggunakan lokasi perangkat.
            </p>

            <input
                type="text"
                id="lokasi"
                name="lokasi"
                value="{{ old('lokasi') }}"
                placeholder="Klik titik pada peta"
                required
                readonly
            >

        </div>

        <br>


        {{-- MAPS --}}
        <div>

            <label>
                <strong>Pilih Lokasi pada Peta</strong>
            </label>

            <div id="map"></div>


            {{-- TOMBOL LOKASI PERANGKAT --}}
            <button
                type="button"
                id="btn-location"
                class="location-button"
            >
                📍 Gunakan Lokasi Saya
            </button>


            {{-- INFORMASI KOORDINAT --}}
            <div class="map-info">

                <div>

                    <strong>Latitude:</strong>

                    <span id="latitude_text">
                        Belum dipilih
                    </span>

                </div>

                <div>

                    <strong>Longitude:</strong>

                    <span id="longitude_text">
                        Belum dipilih
                    </span>

                </div>

            </div>

        </div>


        {{-- LATITUDE --}}
        <input
            type="hidden"
            name="latitude"
            id="latitude"
            value="{{ old('latitude') }}"
        >


        {{-- LONGITUDE --}}
        <input
            type="hidden"
            name="longitude"
            id="longitude"
            value="{{ old('longitude') }}"
        >

        <br>


        {{-- GAMBAR --}}
        <div>

            <label>
                Gambar
            </label>

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


        {{-- TANGGAL --}}
        <div>

            <label>
                Tanggal Pengajuan
            </label>

            <br>

            <input
                type="date"
                name="tanggal"
                value="{{ old('tanggal', date('Y-m-d')) }}"
                required
            >

        </div>

        <br>


        <button type="submit">
            Kirim Pengajuan
        </button>

    </form>


    {{-- Leaflet JS --}}
    <script
        src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
    </script>


    <script>

        /*
        |--------------------------------------------------------------------------
        | LOKASI AWAL PETA
        |--------------------------------------------------------------------------
        */

        const defaultLatitude = -2.5489;
        const defaultLongitude = 118.0149;


        /*
        |--------------------------------------------------------------------------
        | MEMBUAT PETA
        |--------------------------------------------------------------------------
        */

        const map = L.map('map').setView(
            [defaultLatitude, defaultLongitude],
            5
        );


        /*
        |--------------------------------------------------------------------------
        | OPENSTREETMAP
        |--------------------------------------------------------------------------
        */

        L.tileLayer(
            'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap contributors'
            }
        ).addTo(map);


        /*
        |--------------------------------------------------------------------------
        | MARKER
        |--------------------------------------------------------------------------
        */

        let marker = null;


        /*
        |--------------------------------------------------------------------------
        | FUNGSI MEMILIH LOKASI
        |--------------------------------------------------------------------------
        */

        function setLocation(latitude, longitude) {

            latitude = parseFloat(latitude);
            longitude = parseFloat(longitude);


            /*
            | Hapus marker lama
            */

            if (marker) {

                map.removeLayer(marker);

            }


            /*
            | Buat marker baru
            */

            marker = L.marker([
                latitude,
                longitude
            ])
            .addTo(map);


            /*
            | Pindahkan peta ke lokasi
            */

            map.setView(
                [latitude, longitude],
                17
            );


            /*
            | Isi latitude
            */

            document.getElementById('latitude').value =
                latitude.toFixed(7);


            /*
            | Isi longitude
            */

            document.getElementById('longitude').value =
                longitude.toFixed(7);


            /*
            | Tampilkan latitude
            */

            document.getElementById('latitude_text').textContent =
                latitude.toFixed(7);


            /*
            | Tampilkan longitude
            */

            document.getElementById('longitude_text').textContent =
                longitude.toFixed(7);


            /*
            | Isi lokasi yang akan disimpan
            */

            document.getElementById('lokasi').value =
                'Latitude: ' +
                latitude.toFixed(7) +
                ', Longitude: ' +
                longitude.toFixed(7);


            /*
            | Popup marker
            */

            marker.bindPopup(
                '<strong>Lokasi Pengaduan</strong><br>' +
                'Latitude: ' + latitude.toFixed(7) +
                '<br>' +
                'Longitude: ' + longitude.toFixed(7)
            ).openPopup();

        }


        /*
        |--------------------------------------------------------------------------
        | JIKA ADA DATA LAMA
        |--------------------------------------------------------------------------
        */

        const oldLatitude =
            document.getElementById('latitude').value;

        const oldLongitude =
            document.getElementById('longitude').value;


        if (oldLatitude && oldLongitude) {

            setLocation(
                oldLatitude,
                oldLongitude
            );

        }


        /*
        |--------------------------------------------------------------------------
        | KLIK PETA
        |--------------------------------------------------------------------------
        */

        map.on('click', function (e) {

            setLocation(
                e.latlng.lat,
                e.latlng.lng
            );

        });


        /*
        |--------------------------------------------------------------------------
        | GUNAKAN LOKASI PERANGKAT
        |--------------------------------------------------------------------------
        */

        document
            .getElementById('btn-location')
            .addEventListener('click', function () {


                /*
                | Cek apakah browser mendukung GPS
                */

                if (!navigator.geolocation) {

                    alert(
                        'Browser kamu tidak mendukung lokasi perangkat.'
                    );

                    return;

                }


                /*
                | Ubah teks tombol
                */

                this.textContent =
                    '⏳ Mencari lokasi...';


                /*
                | Ambil lokasi
                */

                navigator.geolocation.getCurrentPosition(

                    function (position) {

                        const latitude =
                            position.coords.latitude;

                        const longitude =
                            position.coords.longitude;


                        /*
                        | Masukkan lokasi
                        */

                        setLocation(
                            latitude,
                            longitude
                        );


                        /*
                        | Kembalikan tombol
                        */

                        document
                            .getElementById('btn-location')
                            .textContent =
                            '📍 Gunakan Lokasi Saya';

                    },

                    function (error) {

                        document
                            .getElementById('btn-location')
                            .textContent =
                            '📍 Gunakan Lokasi Saya';


                        if (error.code === 1) {

                            alert(
                                'Izin lokasi ditolak. Silakan izinkan akses lokasi pada browser.'
                            );

                        } else {

                            alert(
                                'Lokasi tidak dapat ditemukan. Silakan pilih titik langsung pada peta.'
                            );

                        }

                    },

                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }

                );

            });


        /*
        |--------------------------------------------------------------------------
        | MEMPERBAIKI UKURAN PETA
        |--------------------------------------------------------------------------
        */

        setTimeout(function () {

            map.invalidateSize();

        }, 300);

    </script>

</body>

</html>