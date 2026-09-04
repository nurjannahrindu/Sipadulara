@extends('layouts.masyarakat')

@section('title', 'Buat Pengajuan - SIPADULARA')

@section('styles')

<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
/>

<style>

    .form-card {
        max-width: 920px;
        margin: 0 auto;
        padding: 30px;
    }

    .form-header {
        display: flex;
        align-items: center;
        gap: 15px;
        padding-bottom: 22px;
        margin-bottom: 28px;
        border-bottom: 1px solid #e2e8f0;
    }

    .form-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background: #eff6ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
        flex-shrink: 0;
    }

    .form-header h2 {
        margin: 0 0 5px;
        color: #0f172a;
        font-size: 18px;
        font-weight: 700;
    }

    .form-header p {
        margin: 0;
        color: #64748b;
        font-size: 13px;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #334155;
        font-size: 13px;
        font-weight: 600;
    }

    .form-group label span {
        color: #dc2626;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #cbd5e1;
        border-radius: 9px;
        background: white;
        color: #334155;
        font-family: inherit;
        font-size: 13px;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
        box-sizing: border-box;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .10);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 160px;
        line-height: 1.6;
    }

    .form-help {
        display: block;
        margin-top: 7px;
        color: #94a3b8;
        font-size: 11px;
        line-height: 1.5;
    }

    .error-text {
        display: block;
        margin-top: 6px;
        color: #dc2626;
        font-size: 11px;
    }

    /* =========================================================
       PENCARIAN LOKASI
    ========================================================= */

    .location-search {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
    }

    .location-search input {
        flex: 1;
    }

    .btn-search-location {
        flex-shrink: 0;
        border: none;
        background: #2563eb;
        color: white;
        padding: 0 20px;
        border-radius: 9px;
        cursor: pointer;
        font-family: inherit;
        font-size: 13px;
        font-weight: 600;
        min-width: 145px;
    }

    .btn-search-location:hover {
        background: #1d4ed8;
    }

    .btn-search-location:disabled {
        background: #94a3b8;
        cursor: not-allowed;
    }

    .search-status {
        display: none;
        padding: 10px 13px;
        margin-bottom: 10px;
        border-radius: 8px;
        background: #eff6ff;
        border: 1px solid #dbeafe;
        color: #1e40af;
        font-size: 12px;
        line-height: 1.5;
    }

    .search-status.show {
        display: block;
    }

    .search-status.success {
        background: #f0fdf4;
        border-color: #bbf7d0;
        color: #166534;
    }

    .search-status.error {
        background: #fef2f2;
        border-color: #fecaca;
        color: #991b1b;
    }

    .search-results {
        display: none;
        margin-bottom: 12px;
        border: 1px solid #dbeafe;
        border-radius: 9px;
        overflow: hidden;
        background: white;
    }

    .search-results.show {
        display: block;
    }

    .search-result-item {
        display: block;
        width: 100%;
        border: none;
        border-bottom: 1px solid #e2e8f0;
        background: white;
        padding: 13px 14px;
        text-align: left;
        cursor: pointer;
        font-family: inherit;
    }

    .search-result-item:last-child {
        border-bottom: none;
    }

    .search-result-item:hover {
        background: #f8fafc;
    }

    .result-name {
        display: block;
        color: #0f172a;
        font-size: 13px;
        font-weight: 700;
        line-height: 1.5;
    }

    .result-address {
        display: block;
        margin-top: 3px;
        color: #64748b;
        font-size: 11px;
        line-height: 1.5;
    }

    /* =========================================================
       MAP
    ========================================================= */

    #map {
        width: 100%;
        height: 560px;
        margin-top: 10px;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        overflow: hidden;
        background: #d1d5db;
        z-index: 1;
    }

    .map-note {
        margin-top: 9px;
        padding: 11px 13px;
        border-radius: 8px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #64748b;
        font-size: 11px;
        line-height: 1.6;
    }

    .selected-location {
        display: none;
        margin-top: 12px;
        padding: 13px 15px;
        border-radius: 9px;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #166534;
        font-size: 12px;
        line-height: 1.6;
    }

    .selected-location strong {
        display: block;
        margin-bottom: 3px;
    }

    /* =========================================================
       FOTO
    ========================================================= */

    .photo-box {
        padding: 15px;
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 10px;
    }

    .photo-box input[type="file"] {
        padding: 10px;
        background: white;
        cursor: pointer;
    }

    .photo-preview {
        display: none;
        margin-top: 12px;
    }

    .photo-preview img {
        display: block;
        max-width: 300px;
        max-height: 220px;
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        object-fit: cover;
    }

    /* =========================================================
       INFO
    ========================================================= */

    .info-box {
        display: flex;
        gap: 12px;
        padding: 15px 17px;
        margin-top: 5px;
        margin-bottom: 28px;
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 10px;
        color: #1e40af;
    }

    .info-icon {
        flex-shrink: 0;
        font-size: 17px;
    }

    .info-box strong {
        display: block;
        margin-bottom: 5px;
        font-size: 12px;
    }

    .info-box p {
        margin: 0;
        font-size: 11px;
        line-height: 1.6;
    }

    /* =========================================================
       BUTTON
    ========================================================= */

    .form-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 10px;
        padding-top: 22px;
        border-top: 1px solid #e2e8f0;
    }

    .form-actions .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 11px 18px;
        border-radius: 8px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-family: inherit;
        font-size: 13px;
        font-weight: 600;
    }

    .form-actions .btn-primary {
        background: #2563eb;
        color: white;
    }

    .form-actions .btn-primary:hover {
        background: #1d4ed8;
    }

    .form-actions .btn-secondary {
        background: #64748b;
        color: white;
    }

    .form-actions .btn-secondary:hover {
        background: #475569;
    }

    /* =========================================================
       MOBILE
    ========================================================= */

    @media (max-width: 700px) {

        .form-card {
            padding: 20px;
        }

        .location-search {
            flex-direction: column;
        }

        .btn-search-location {
            min-height: 42px;
            width: 100%;
        }

        #map {
            height: 420px;
        }

        .form-actions {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .form-actions .btn {
            width: 100%;
        }

    }

</style>

@endsection


@section('content')

<div class="page-header">

    <div>

        <h1 class="page-title">
            Buat Pengajuan
        </h1>

        <p class="page-description">
            Sampaikan pengaduan atau laporan Anda kepada pemerintah.
        </p>

    </div>

</div>


<div class="card form-card">

    <div class="form-header">

        <div class="form-icon">
            📝
        </div>

        <div>

            <h2>
                Form Pengajuan Masyarakat
            </h2>

            <p>
                Silakan isi data pengaduan dengan lengkap dan benar.
            </p>

        </div>

    </div>


    <form
        action="{{ route('masyarakat.pengajuan.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        {{-- =====================================================
             JUDUL
        ====================================================== --}}

        <div class="form-group">

            <label for="judul">
                Judul Pengajuan
                <span>*</span>
            </label>

            <input
                type="text"
                id="judul"
                name="judul"
                value="{{ old('judul') }}"
                placeholder="Contoh: Jalan rusak di depan kantor desa"
                required
            >

            @error('judul')
                <small class="error-text">
                    {{ $message }}
                </small>
            @enderror

        </div>


        {{-- =====================================================
             KATEGORI
        ====================================================== --}}

        <div class="form-group">

            <label for="id_kategori">
                Kategori
                <span>*</span>
            </label>

            <select
                id="id_kategori"
                name="id_kategori"
                required
            >

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

            @error('id_kategori')
                <small class="error-text">
                    {{ $message }}
                </small>
            @enderror

        </div>


        {{-- =====================================================
             LOKASI
        ====================================================== --}}

        <div class="form-group">

            <label for="lokasi-search">
                Cari Lokasi Pengaduan
                <span>*</span>
            </label>


            <div class="location-search">

                <input
                    type="text"
                    id="lokasi-search"
                    value="{{ old('lokasi_search') }}"
                    placeholder="Contoh: Batu Balang, Payakumbuh"
                    autocomplete="off"
                >

                <button
                    type="button"
                    id="btn-cari-lokasi"
                    class="btn-search-location"
                >
                    🔍 Cari Lokasi
                </button>

            </div>


            <small class="form-help">

                Ketik nama wilayah, alamat, jalan, tempat wisata,
                atau lokasi tertentu.

                Setelah ditemukan, peta akan <strong>langsung diarahkan
                ke lokasi tersebut</strong>.

                Setelah itu kamu dapat memperbesar peta dan klik
                tepat pada titik pengaduan.

            </small>


            {{-- STATUS --}}

            <div
                id="search-status"
                class="search-status"
            ></div>


            {{-- HASIL PENCARIAN ALTERNATIF --}}

            <div
                id="search-results"
                class="search-results"
            ></div>


            {{-- LOKASI FINAL --}}

            <input
                type="text"
                id="lokasi"
                name="lokasi"
                value="{{ old('lokasi') }}"
                placeholder="Klik titik pada peta untuk menentukan lokasi pengaduan"
                readonly
                required
            >


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


            {{-- MAP --}}

            <div id="map"></div>


            <div class="map-note">

                📍 <strong>Cara menggunakan peta:</strong>

                <br>

                <strong>1.</strong>
                Ketik lokasi pada kotak pencarian.

                <br>

                <strong>2.</strong>
                Klik <strong>🔍 Cari Lokasi</strong>.

                <br>

                <strong>3.</strong>
                Peta akan langsung bergerak menuju lokasi tersebut
                dan diperbesar.

                <br>

                <strong>4.</strong>
                Gunakan tombol <strong>+</strong> untuk memperbesar
                sampai rumah/jalan terlihat jelas.

                <br>

                <strong>5.</strong>
                Klik tepat pada rumah, jalan, bangunan,
                atau tempat yang ingin dilaporkan.

                <br>

                <strong>6.</strong>
                Koordinat yang disimpan adalah
                <strong>titik yang kamu klik.</strong>

            </div>


            {{-- TITIK TERPILIH --}}

            <div
                id="selected-location"
                class="selected-location"
            >

                <strong>
                    📍 Titik Pengaduan Dipilih
                </strong>

                <span id="selected-location-text"></span>

            </div>


            @error('lokasi')
                <small class="error-text">
                    {{ $message }}
                </small>
            @enderror


            @error('latitude')
                <small class="error-text">
                    {{ $message }}
                </small>
            @enderror


            @error('longitude')
                <small class="error-text">
                    {{ $message }}
                </small>
            @enderror

        </div>


        {{-- =====================================================
             FOTO
        ====================================================== --}}

        <div class="form-group">

            <label for="gambar">
                Foto Pengaduan
            </label>

            <div class="photo-box">

                <input
                    type="file"
                    id="gambar"
                    name="gambar"
                    accept="image/jpeg,image/png,image/jpg,image/webp"
                >

                <small class="form-help">

                    Upload foto kondisi yang ingin dilaporkan.
                    Format JPG, JPEG, PNG, atau WEBP.
                    Maksimal 2 MB.

                </small>


                <div
                    id="photo-preview"
                    class="photo-preview"
                >

                    <img
                        id="photo-preview-image"
                        src=""
                        alt="Preview Foto"
                    >

                </div>

            </div>


            @error('gambar')
                <small class="error-text">
                    {{ $message }}
                </small>
            @enderror

        </div>


        {{-- =====================================================
             TANGGAL
        ====================================================== --}}

        <div class="form-group">

            <label for="tanggal">
                Tanggal Pengajuan
                <span>*</span>
            </label>

            <input
                type="date"
                id="tanggal"
                name="tanggal"
                value="{{ old('tanggal', date('Y-m-d')) }}"
                required
            >

            @error('tanggal')
                <small class="error-text">
                    {{ $message }}
                </small>
            @enderror

        </div>


        {{-- =====================================================
             KETERANGAN
        ====================================================== --}}

        <div class="form-group">

            <label for="keterangan">
                Isi Pengaduan
                <span>*</span>
            </label>

            <textarea
                id="keterangan"
                name="keterangan"
                rows="7"
                placeholder="Jelaskan masalah atau pengaduan yang ingin disampaikan secara lengkap..."
                required
            >{{ old('keterangan') }}</textarea>

            <small class="form-help">

                Jelaskan kondisi, lokasi, dan informasi lain
                yang dapat membantu proses penanganan.

            </small>

            @error('keterangan')
                <small class="error-text">
                    {{ $message }}
                </small>
            @enderror

        </div>


        {{-- =====================================================
             INFO
        ====================================================== --}}

        <div class="info-box">

            <div class="info-icon">
                ℹ️
            </div>

            <div>

                <strong>
                    Perhatian
                </strong>

                <p>

                    Pastikan lokasi yang dipilih pada peta sudah benar.
                    Koordinat yang kamu klik akan digunakan oleh administrator
                    untuk mengetahui lokasi pengaduan.

                </p>

            </div>

        </div>


        {{-- =====================================================
             BUTTON
        ====================================================== --}}

        <div class="form-actions">

            <a
                href="{{ route('masyarakat.pengajuan.index') }}"
                class="btn btn-secondary"
            >
                ← Kembali
            </a>

            <button
                type="submit"
                class="btn btn-primary"
            >
                📤 Kirim Pengajuan
            </button>

        </div>

    </form>

</div>

@endsection


@section('scripts')

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | ELEMENT
    |--------------------------------------------------------------------------
    */

    const searchInput =
        document.getElementById('lokasi-search');

    const searchButton =
        document.getElementById('btn-cari-lokasi');

    const searchStatus =
        document.getElementById('search-status');

    const searchResults =
        document.getElementById('search-results');

    const lokasiInput =
        document.getElementById('lokasi');

    const latitudeInput =
        document.getElementById('latitude');

    const longitudeInput =
        document.getElementById('longitude');

    const selectedLocation =
        document.getElementById('selected-location');

    const selectedLocationText =
        document.getElementById('selected-location-text');


    /*
    |--------------------------------------------------------------------------
    | LOKASI AWAL
    |--------------------------------------------------------------------------
    |
    | Payakumbuh / sekitar Batu Balang
    |
    */

    const defaultLat = -0.2200;
    const defaultLng = 100.6300;


    /*
    |--------------------------------------------------------------------------
    | BUAT MAP
    |--------------------------------------------------------------------------
    */

    const map = L.map('map', {

        center: [
            defaultLat,
            defaultLng
        ],

        zoom: 12,

        zoomControl: true,

        scrollWheelZoom: true,

        doubleClickZoom: true,

        dragging: true

    });


    /*
    |--------------------------------------------------------------------------
    | SATELIT
    |--------------------------------------------------------------------------
    */

    const satelliteLayer = L.tileLayer(
        'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
        {
            maxZoom: 22,
            maxNativeZoom: 19,
            attribution: 'Tiles &copy; Esri'
        }
    ).addTo(map);


    /*
    |--------------------------------------------------------------------------
    | JALAN + LABEL
    |--------------------------------------------------------------------------
    */

    const roadLayer = L.tileLayer(

        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',

        {

            maxZoom: 19,

            opacity: 0.65,

            attribution:
                '&copy; OpenStreetMap contributors'

        }

    );


    /*
    |--------------------------------------------------------------------------
    | DEFAULT = SATELIT + JALAN/LABEL
    |--------------------------------------------------------------------------
    */

    satelliteLayer.addTo(map);

    roadLayer.addTo(map);


    /*
    |--------------------------------------------------------------------------
    | LAYER CONTROL
    |--------------------------------------------------------------------------
    */

    L.control.layers(

        {

            '🛰️ Satelit': satelliteLayer,

            '🗺️ Peta Jalan': L.tileLayer(
                'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                {
                    maxZoom: 19,
                    attribution:
                        '&copy; OpenStreetMap contributors'
                }
            )

        },

        {

            '🛣️ Jalan & Nama Wilayah': roadLayer

        },

        {

            collapsed: false

        }

    ).addTo(map);


    /*
    |--------------------------------------------------------------------------
    | MARKER FINAL
    |--------------------------------------------------------------------------
    */

    let marker = null;


    /*
    |--------------------------------------------------------------------------
    | MARKER PENCARIAN
    |--------------------------------------------------------------------------
    */

    let searchMarker = null;


    /*
    |--------------------------------------------------------------------------
    | PERBAIKI UKURAN MAP
    |--------------------------------------------------------------------------
    */

    setTimeout(function () {

        map.invalidateSize(true);

    }, 300);


    setTimeout(function () {

        map.invalidateSize(true);

    }, 1000);


    /*
    |--------------------------------------------------------------------------
    | STATUS
    |--------------------------------------------------------------------------
    */

    function showStatus(message, type = '') {

        searchStatus.textContent = message;

        searchStatus.classList.add('show');

        searchStatus.classList.remove(
            'success',
            'error'
        );

        if (type) {
            searchStatus.classList.add(type);
        }

    }


    function hideStatus() {

        searchStatus.textContent = '';

        searchStatus.classList.remove(
            'show',
            'success',
            'error'
        );

    }


    /*
    |--------------------------------------------------------------------------
    | CLEAR HASIL
    |--------------------------------------------------------------------------
    */

    function clearSearchResults() {

        searchResults.innerHTML = '';

        searchResults.classList.remove('show');

    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS MARKER PENCARIAN
    |--------------------------------------------------------------------------
    */

    function removeSearchMarker() {

        if (searchMarker) {

            map.removeLayer(searchMarker);

            searchMarker = null;

        }

    }


    /*
    |--------------------------------------------------------------------------
    | SET TITIK PENGADUAN
    |--------------------------------------------------------------------------
    */

    function setMarker(
        latitude,
        longitude,
        locationName = 'Lokasi Pengaduan'
    ) {

        /*
        | Hapus marker final lama
        */

        if (marker) {

            map.removeLayer(marker);

        }


        /*
        | Hapus marker pencarian
        */

        removeSearchMarker();


        /*
        | Buat marker final
        */

        marker = L.marker(
            [
                latitude,
                longitude
            ]
        ).addTo(map);


        /*
        | Koordinat
        */

        const lat =
            Number(latitude).toFixed(7);

        const lng =
            Number(longitude).toFixed(7);


        /*
        | Simpan koordinat
        */

        latitudeInput.value = lat;

        longitudeInput.value = lng;


        /*
        | Simpan lokasi
        */

        lokasiInput.value =
            locationName +
            ' (Latitude: ' +
            lat +
            ', Longitude: ' +
            lng +
            ')';


        /*
        | Tampilkan informasi
        */

        selectedLocationText.textContent =
            lokasiInput.value;

        selectedLocation.style.display =
            'block';


        /*
        | Popup
        */

        marker.bindPopup(

            '<strong>📍 Titik Pengaduan</strong><br>' +

            'Lokasi: ' +
            escapeHtml(locationName) +

            '<br><br>' +

            'Latitude: ' +
            lat +

            '<br>' +

            'Longitude: ' +
            lng

        ).openPopup();

    }


    /*
    |--------------------------------------------------------------------------
    | ESCAPE HTML
    |--------------------------------------------------------------------------
    */

    function escapeHtml(text) {

        const div =
            document.createElement('div');

        div.textContent =
            text;

        return div.innerHTML;

    }


    /*
    |--------------------------------------------------------------------------
    | KLIK PETA
    |--------------------------------------------------------------------------
    |
    | INI TITIK YANG BENAR-BENAR DISIMPAN
    |
    */

    map.on('click', function (e) {

        const latitude =
            e.latlng.lat;

        const longitude =
            e.latlng.lng;


        /*
        | Nama lokasi
        */

        const nama =
            searchInput.value.trim() ||
            'Titik pilihan pada peta';


        /*
        | Simpan titik yang diklik
        */

        setMarker(

            latitude,

            longitude,

            nama

        );


        /*
        | Pesan sukses
        */

        showStatus(

            '✓ Titik pengaduan berhasil dipilih. Koordinat sesuai dengan titik yang kamu klik.',

            'success'

        );

    });


    /*
    |--------------------------------------------------------------------------
    | FUNGSI UTAMA:
    | ARAHKAN MAP KE HASIL PENCARIAN
    |--------------------------------------------------------------------------
    */

    function goToSearchResult(
        latitude,
        longitude,
        displayName,
        autoZoom = true
    ) {

        /*
        | Hapus marker pencarian lama
        */

        removeSearchMarker();


        /*
        | Buat marker sementara
        */

        searchMarker =
            L.marker(

                [
                    latitude,
                    longitude
                ],

                {

                    title:
                        'Lokasi hasil pencarian',

                    autoPan:
                        true

                }

            ).addTo(map);


        /*
        | Popup pencarian
        */

        searchMarker.bindPopup(

            '<strong>🔎 Lokasi ditemukan</strong><br>' +

            escapeHtml(displayName) +

            '<br><br>' +

            '<small>' +

            'Perbesar peta lalu klik tepat pada titik pengaduan.' +

            '</small>'

        ).openPopup();


        /*
        |--------------------------------------------------------------------------
        | INI BAGIAN PENTING
        |--------------------------------------------------------------------------
        |
        | Map benar-benar diarahkan ke koordinat hasil pencarian.
        |
        */

        map.flyTo(
            [
                latitude,
                longitude
            ],

            autoZoom ? 22 : 19,

            {
                animate: true,
                duration: 2.0,
                easeLinearity: 0.25
            }
        );


        /*
        | Setelah animasi selesai,
        | pastikan posisi benar-benar berada di titik tersebut.
        */

        setTimeout(function () {

            map.setView(

                [
                    latitude,
                    longitude
                ],

                autoZoom ? 22 : 19,

                {

                    animate: true

                }

            );

            map.invalidateSize(true);

        }, 2100);


        /*
        | Status
        */

        showStatus(

            '✓ Peta diarahkan ke: ' +
            displayName +
            '. Sekarang perbesar lagi jika perlu, lalu klik tepat pada titik pengaduan.',

            'success'

        );

    }


    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN HASIL PENCARIAN
    |--------------------------------------------------------------------------
    */

    function displaySearchResults(results) {

        clearSearchResults();


        results.forEach(function (result, index) {

            const button =
                document.createElement('button');


            button.type =
                'button';


            button.className =
                'search-result-item';


            /*
            | Nama
            */

            const name =
                document.createElement('span');

            name.className =
                'result-name';

            name.textContent =
                result.name ||
                result.display_name ||
                'Lokasi';


            /*
            | Alamat
            */

            const address =
                document.createElement('span');

            address.className =
                'result-address';

            address.textContent =
                result.display_name;


            button.appendChild(name);

            button.appendChild(address);


            /*
            | Klik hasil alternatif
            */

            button.addEventListener(
                'click',
                function () {

                    const latitude =
                        parseFloat(result.lat);

                    const longitude =
                        parseFloat(result.lon);


                    if (
                        isNaN(latitude) ||
                        isNaN(longitude)
                    ) {

                        showStatus(
                            'Koordinat lokasi tidak valid.',
                            'error'
                        );

                        return;

                    }


                    searchInput.value =
                        result.display_name;


                    goToSearchResult(

                        latitude,

                        longitude,

                        result.display_name,

                        true

                    );


                    clearSearchResults();

                }
            );


            searchResults.appendChild(button);

        });


        searchResults.classList.add('show');

    }


    /*
    |--------------------------------------------------------------------------
    | CARI LOKASI
    |--------------------------------------------------------------------------
    */

    async function searchLocation() {

        const query =
            searchInput.value.trim();


        /*
        | Validasi
        */

        if (!query) {

            showStatus(
                'Silakan ketik lokasi terlebih dahulu.',
                'error'
            );

            searchInput.focus();

            return;

        }


        /*
        | Loading
        */

        searchButton.disabled = true;

        searchButton.textContent =
            '⏳ Mencari...';

        clearSearchResults();

        showStatus(
            '🔎 Sedang mencari "' +
            query +
            '"...'
        );


        try {

            /*
            |--------------------------------------------------------------------------
            | NOMINATIM
            |--------------------------------------------------------------------------
            */

            const url =
                'https://nominatim.openstreetmap.org/search' +

                '?format=jsonv2' +

                '&q=' +
                encodeURIComponent(query) +

                '&format=jsonv2' +

                '&limit=8' +

                '&countrycodes=id' +

                '&addressdetails=1' +

                '&accept-language=id';


            const response =
                await fetch(

                    url,

                    {

                        method: 'GET',

                        headers: {

                            'Accept':
                                'application/json'

                        }

                    }

                );


            /*
            | Cek response
            */

            if (!response.ok) {

                throw new Error(
                    'Server pencarian tidak merespons.'
                );

            }


            /*
            | Ambil data
            */

            const results =
                await response.json();


            /*
            | Tidak ada hasil
            */

            if (
                !Array.isArray(results) ||
                results.length === 0
            ) {

                clearSearchResults();

                showStatus(

                    '❌ Lokasi "' +
                    query +
                    '" tidak ditemukan. Coba tambahkan kecamatan, kabupaten, atau nama jalan.',

                    'error'

                );

                return;

            }


            /*
            |--------------------------------------------------------------------------
            | HASIL PERTAMA LANGSUNG DIPAKAI
            |--------------------------------------------------------------------------
            |
            | INI PERUBAHAN PALING PENTING.
            |
            | Sebelumnya:
            |   harus klik hasil pencarian dulu.
            |
            | Sekarang:
            |   tekan Cari Lokasi
            |   ↓
            |   hasil pertama langsung dipakai
            |   ↓
            |   map langsung bergerak
            |   ↓
            |   zoom 18
            |
            */

            const firstResult =
                results[0];


            const latitude =
                parseFloat(firstResult.lat);


            const longitude =
                parseFloat(firstResult.lon);


            if (
                isNaN(latitude) ||
                isNaN(longitude)
            ) {

                throw new Error(
                    'Koordinat hasil pencarian tidak valid.'
                );

            }


            const displayName =
                firstResult.display_name ||
                query;


            /*
            | Masukkan nama hasil ke pencarian
            */

            searchInput.value =
                displayName;


            /*
            |--------------------------------------------------------------------------
            | LANGSUNG ARAHKAN MAP
            |--------------------------------------------------------------------------
            */

            goToSearchResult(

                latitude,

                longitude,

                displayName,

                true

            );


            /*
            |--------------------------------------------------------------------------
            | TAMPILKAN HASIL ALTERNATIF
            |--------------------------------------------------------------------------
            |
            | Kalau hasilnya lebih dari satu,
            | tetap boleh memilih lokasi lain.
            |
            */

            if (results.length > 1) {

                displaySearchResults(results);

            }


        } catch (error) {

            console.error(
                'Kesalahan pencarian lokasi:',
                error
            );


            showStatus(

                '❌ Tidak dapat mencari lokasi. Pastikan internet aktif dan coba lagi.',

                'error'

            );

        } finally {

            searchButton.disabled = false;

            searchButton.textContent =
                '🔍 Cari Lokasi';

        }

    }


    /*
    |--------------------------------------------------------------------------
    | BUTTON CARI
    |--------------------------------------------------------------------------
    */

    searchButton.addEventListener(

        'click',

        searchLocation

    );


    /*
    |--------------------------------------------------------------------------
    | ENTER
    |--------------------------------------------------------------------------
    */

    searchInput.addEventListener(

        'keydown',

        function (event) {

            if (event.key === 'Enter') {

                event.preventDefault();

                searchLocation();

            }

        }

    );


    /*
    |--------------------------------------------------------------------------
    | PREVIEW FOTO
    |--------------------------------------------------------------------------
    */

    const fotoInput =
        document.getElementById('gambar');

    const photoPreview =
        document.getElementById('photo-preview');

    const photoPreviewImage =
        document.getElementById('photo-preview-image');


    fotoInput.addEventListener(

        'change',

        function () {

            const file =
                this.files[0];


            if (!file) {

                photoPreview.style.display =
                    'none';

                photoPreviewImage.src =
                    '';

                return;

            }


            /*
            | Maksimal 2 MB
            */

            if (
                file.size >
                2 * 1024 * 1024
            ) {

                alert(
                    'Ukuran foto maksimal 2 MB.'
                );

                this.value =
                    '';

                photoPreview.style.display =
                    'none';

                return;

            }


            /*
            | Preview
            */

            const reader =
                new FileReader();


            reader.onload =
                function (event) {

                    photoPreviewImage.src =
                        event.target.result;

                    photoPreview.style.display =
                        'block';

                };


            reader.readAsDataURL(file);

        }

    );


    /*
    |--------------------------------------------------------------------------
    | KEMBALIKAN LOKASI LAMA
    |--------------------------------------------------------------------------
    */

    const oldLatitude =
        latitudeInput.value;

    const oldLongitude =
        longitudeInput.value;


    if (
        oldLatitude &&
        oldLongitude
    ) {

        const lat =
            parseFloat(oldLatitude);

        const lng =
            parseFloat(oldLongitude);


        if (
            !isNaN(lat) &&
            !isNaN(lng)
        ) {

            setMarker(

                lat,

                lng,

                searchInput.value ||
                'Lokasi Pengajuan'

            );


            map.setView(

                [
                    lat,
                    lng
                ],

                18

            );

        }

    }


    /*
    |--------------------------------------------------------------------------
    | RESPONSIVE
    |--------------------------------------------------------------------------
    */

    window.addEventListener(

        'resize',

        function () {

            setTimeout(function () {

                map.invalidateSize(true);

            }, 100);

        }

    );

});

</script>

@endsection