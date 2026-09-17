@extends('layouts.masyarakat')

@section('title', 'Edit Pengajuan - SIPADULARA')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Edit Pengajuan</h1>
        <p class="page-description">
            Ubah data pengajuan yang telah Anda buat.
        </p>
    </div>
</div>

<div class="card form-card">

```
{{-- HEADER FORM --}}
<div class="form-header">

    <div class="form-icon">
        ✏️
    </div>

    <div>
        <h2>Edit Pengajuan Masyarakat</h2>

        <p>
            Periksa kembali data sebelum menyimpan perubahan.
        </p>
    </div>

</div>


{{-- ERROR VALIDASI --}}
@if ($errors->any())

    <div class="error-box">

        <strong>
            Terdapat kesalahan pada data:
        </strong>

        <ul>
            @foreach ($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

            @endforeach
        </ul>

    </div>

@endif


<form
    action="{{ route('masyarakat.pengajuan.update', $pengajuan->id_pengajuan) }}"
    method="POST"
>

    @csrf
    @method('PUT')


    {{-- ============================= --}}
    {{-- JUDUL --}}
    {{-- ============================= --}}

    <div class="form-group">

        <label for="judul">
            Judul Pengajuan
            <span>*</span>
        </label>

        <input
            type="text"
            id="judul"
            name="judul"
            value="{{ old('judul', $pengajuan->judul) }}"
            placeholder="Contoh: Jalan rusak di depan kantor desa"
            required
        >

        @error('judul')

            <small class="error-text">
                {{ $message }}
            </small>

        @enderror

    </div>


    {{-- ============================= --}}
    {{-- KATEGORI --}}
    {{-- ============================= --}}

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
                    {{ old('id_kategori', $pengajuan->id_kategori) == $kategori->id_kategori ? 'selected' : '' }}
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


    {{-- ============================= --}}
    {{-- LOKASI --}}
    {{-- ============================= --}}

    <div class="form-group">

        <label for="lokasi">
            Lokasi Pengaduan
            <span>*</span>
        </label>

        <input
            type="text"
            id="lokasi"
            name="lokasi"
            value="{{ old('lokasi', $pengajuan->lokasi) }}"
            placeholder="Klik titik lokasi pada peta"
            readonly
            required
        >

        <small class="form-help">
            Klik pada peta untuk mengubah lokasi pengaduan.
        </small>


        {{-- MAP --}}

        <div id="map"></div>


        {{-- LATITUDE --}}

        <input
            type="hidden"
            name="latitude"
            id="latitude"
            value="{{ old('latitude', $pengajuan->latitude) }}"
        >


        {{-- LONGITUDE --}}

        <input
            type="hidden"
            name="longitude"
            id="longitude"
            value="{{ old('longitude', $pengajuan->longitude) }}"
        >


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


    {{-- ============================= --}}
    {{-- TANGGAL --}}
    {{-- ============================= --}}

    <div class="form-group">

        <label for="tanggal">
            Tanggal Pengajuan
            <span>*</span>
        </label>

        <input
            type="date"
            id="tanggal"
            name="tanggal"
            value="{{ old('tanggal', $pengajuan->tanggal ? $pengajuan->tanggal->format('Y-m-d') : '') }}"
            required
        >

        @error('tanggal')

            <small class="error-text">
                {{ $message }}
            </small>

        @enderror

    </div>


    {{-- ============================= --}}
    {{-- KETERANGAN --}}
    {{-- ============================= --}}

    <div class="form-group">

        <label for="keterangan">
            Isi Pengaduan
            <span>*</span>
        </label>

        <textarea
            id="keterangan"
            name="keterangan"
            rows="7"
            placeholder="Jelaskan masalah atau pengaduan..."
            required
        >{{ old('keterangan', $pengajuan->keterangan) }}</textarea>

        <small class="form-help">
            Jelaskan kondisi, lokasi, dan informasi lain yang dapat membantu proses penanganan.
        </small>

        @error('keterangan')

            <small class="error-text">
                {{ $message }}
            </small>

        @enderror

    </div>


    {{-- ============================= --}}
    {{-- INFORMASI --}}
    {{-- ============================= --}}

    <div class="info-box">

        <div class="info-icon">
            ℹ️
        </div>

        <div>

            <strong>Perhatian</strong>

            <p>
                Pengajuan hanya dapat diedit selama status masih
                <strong>diajukan</strong>. Setelah diproses oleh admin,
                data tidak dapat diubah lagi.
            </p>

        </div>

    </div>


    {{-- ============================= --}}
    {{-- TOMBOL --}}
    {{-- ============================= --}}

   <div class="form-actions">

    {{-- TOMBOL KEMBALI --}}
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

    {{-- TOMBOL KIRIM --}}
    <button
        type="submit"
        class="btn btn-primary"
    >
        Kirim Pengajuan
    </button>

</div>

</form>

</div>

{{-- ================================================== --}}
{{-- LEAFLET CSS --}}
{{-- ================================================== --}}

<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
/>

{{-- ================================================== --}}
{{-- LEAFLET JS --}}
{{-- ================================================== --}}

<script
    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
</script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | DATA LOKASI LAMA
    |--------------------------------------------------------------------------
    */

    const latitudeInput =
        document.getElementById('latitude');

    const longitudeInput =
        document.getElementById('longitude');

    const lokasiInput =
        document.getElementById('lokasi');


    /*
    |--------------------------------------------------------------------------
    | AMBIL LATITUDE DAN LONGITUDE
    |--------------------------------------------------------------------------
    */

    let latitude =
        parseFloat(latitudeInput.value);

    let longitude =
        parseFloat(longitudeInput.value);


    /*
    |--------------------------------------------------------------------------
    | JIKA LATITUDE/LONGITUDE KOSONG
    |--------------------------------------------------------------------------
    */

    if (
        isNaN(latitude) ||
        isNaN(longitude)
    ) {

        /*
        | Default Sumatera Barat
        */

        latitude = -0.217;

        longitude = 100.600;

    }


    /*
    |--------------------------------------------------------------------------
    | BUAT MAP
    |--------------------------------------------------------------------------
    */

    const map = L.map('map', {

        center: [
            latitude,
            longitude
        ],

        zoom: 16,

        zoomControl: true

    });


    /*
    |--------------------------------------------------------------------------
    | OPEN STREET MAP
    |--------------------------------------------------------------------------
    */

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {

            maxZoom: 19,

            attribution:
                '&copy; OpenStreetMap contributors'

        }
    ).addTo(map);


    /*
    |--------------------------------------------------------------------------
    | MARKER LAMA
    |--------------------------------------------------------------------------
    */

    let marker =
        L.marker([
            latitude,
            longitude
        ])
        .addTo(map);


    marker.bindPopup(
        '<b>Lokasi Pengaduan</b><br>' +
        'Latitude: ' +
        latitude +
        '<br>' +
        'Longitude: ' +
        longitude
    );


    /*
    |--------------------------------------------------------------------------
    | PERBAIKI UKURAN MAP
    |--------------------------------------------------------------------------
    */

    setTimeout(function () {

        map.invalidateSize();

        map.setView(
            [
                latitude,
                longitude
            ],
            16
        );

    }, 300);


    /*
    |--------------------------------------------------------------------------
    | KLIK PETA
    |--------------------------------------------------------------------------
    */

    map.on('click', function (e) {

        const newLatitude =
            e.latlng.lat.toFixed(7);

        const newLongitude =
            e.latlng.lng.toFixed(7);


        /*
        | HAPUS MARKER LAMA
        */

        if (marker) {

            map.removeLayer(marker);

        }


        /*
        | BUAT MARKER BARU
        */

        marker =
            L.marker([
                e.latlng.lat,
                e.latlng.lng
            ])
            .addTo(map);


        /*
        | UPDATE LATITUDE
        */

        latitudeInput.value =
            newLatitude;


        /*
        | UPDATE LONGITUDE
        */

        longitudeInput.value =
            newLongitude;


        /*
        | UPDATE LOKASI
        */

        lokasiInput.value =
            'Latitude: ' +
            newLatitude +
            ', Longitude: ' +
            newLongitude;


        /*
        | POPUP
        */

        marker.bindPopup(

            '<b>Lokasi Pengaduan</b><br>' +

            'Latitude: ' +
            newLatitude +

            '<br>' +

            'Longitude: ' +
            newLongitude

        ).openPopup();

    });


    /*
    |--------------------------------------------------------------------------
    | RESPONSIVE MAP
    |--------------------------------------------------------------------------
    */

    window.addEventListener(
        'resize',
        function () {

            map.invalidateSize();

        }
    );

});

</script>

<style>

/*
|--------------------------------------------------------------------------
| FORM CARD
|--------------------------------------------------------------------------
*/

.form-card {

    max-width: 920px;

    margin: 0 auto;

    padding: 30px;

}


/*
|--------------------------------------------------------------------------
| HEADER
|--------------------------------------------------------------------------
*/

.form-header {

    display: flex;

    align-items: center;

    gap: 15px;

    padding-bottom: 22px;

    margin-bottom: 28px;

    border-bottom:
        1px solid #e2e8f0;

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


/*
|--------------------------------------------------------------------------
| FORM GROUP
|--------------------------------------------------------------------------
*/

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


/*
|--------------------------------------------------------------------------
| INPUT
|--------------------------------------------------------------------------
*/

.form-group input,
.form-group select,
.form-group textarea {

    width: 100%;

    padding: 12px 14px;

    border:
        1px solid #cbd5e1;

    border-radius: 9px;

    background: white;

    color: #334155;

    font-family: inherit;

    font-size: 13px;

    outline: none;

    transition:
        border-color .2s,
        box-shadow .2s;

}


.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {

    border-color: #2563eb;

    box-shadow:
        0 0 0 3px
        rgba(37, 99, 235, .10);

}


/*
|--------------------------------------------------------------------------
| TEXTAREA
|--------------------------------------------------------------------------
*/

.form-group textarea {

    resize: vertical;

    min-height: 160px;

    line-height: 1.6;

}


/*
|--------------------------------------------------------------------------
| HELP TEXT
|--------------------------------------------------------------------------
*/

.form-help {

    display: block;

    margin-top: 7px;

    color: #94a3b8;

    font-size: 11px;

    line-height: 1.5;

}


/*
|--------------------------------------------------------------------------
| ERROR
|--------------------------------------------------------------------------
*/

.error-text {

    display: block;

    margin-top: 6px;

    color: #dc2626;

    font-size: 11px;

}


.error-box {

    margin-bottom: 24px;

    padding: 15px 18px;

    background: #fef2f2;

    border: 1px solid #fecaca;

    border-radius: 10px;

    color: #991b1b;

    font-size: 13px;

}


.error-box ul {

    margin: 8px 0 0;

    padding-left: 20px;

}


/*
|--------------------------------------------------------------------------
| MAP
|--------------------------------------------------------------------------
*/

#map {

    width: 100%;

    height: 380px;

    margin-top: 12px;

    border:
        1px solid #cbd5e1;

    border-radius: 10px;

    overflow: hidden;

    background: #e2e8f0;

    z-index: 1;

}


#map.leaflet-container {

    width: 100%;

    height: 380px;

}


.leaflet-container {

    font-family:
        'Inter',
        Arial,
        sans-serif;

}


/*
|--------------------------------------------------------------------------
| INFO BOX
|--------------------------------------------------------------------------
*/

.info-box {

    display: flex;

    gap: 12px;

    padding: 15px 17px;

    margin-top: 5px;

    margin-bottom: 28px;

    background: #eff6ff;

    border:
        1px solid #bfdbfe;

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


/*
|--------------------------------------------------------------------------
| BUTTON AREA
|--------------------------------------------------------------------------
*/

.form-actions {

    display: flex;

    justify-content: flex-end;

    align-items: center;

    gap: 10px;

    padding-top: 22px;

    border-top:
        1px solid #e2e8f0;

}


/*
|--------------------------------------------------------------------------
| BUTTON
|--------------------------------------------------------------------------
*/

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


/*
|--------------------------------------------------------------------------
| MOBILE
|--------------------------------------------------------------------------
*/

@media (max-width: 700px) {

    .form-card {

        padding: 20px;

    }


    #map,
    #map.leaflet-container {

        height: 320px;

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
