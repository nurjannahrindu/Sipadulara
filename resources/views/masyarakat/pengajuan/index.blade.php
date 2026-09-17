@extends('layouts.masyarakat')

@section('title', 'Pengajuan Saya')


@section('styles')

<style>

/* =====================================================
   HEADER
===================================================== */

.page-header {
    width: 100%;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 24px;
}

.page-header > div {
    margin: 0;
    padding: 0;
}

.page-title {
    margin: 0;
    padding: 0;
    color: #0f172a;
    font-size: 28px;
    font-weight: 800;
    line-height: 1.2;
}

.page-description {
    margin: 8px 0 14px 0;
    padding: 0;
    color: #64748b;
    font-size: 13px;
    line-height: 1.5;
}

.page-header .btn {
    flex-shrink: 0;
    margin: 0;
}


/* =====================================================
   AKSI TABEL
===================================================== */

.aksi-column {
    width: 120px;
    text-align: center;
}

.aksi-buttons {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    white-space: nowrap;
}

.aksi-btn {
    width: 32px;
    height: 32px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 0;

    border: none;
    border-radius: 8px;

    text-decoration: none;
    cursor: pointer;

    transition:
        transform .2s ease,
        filter .2s ease;
}

.aksi-btn:hover {
    transform: translateY(-2px);
    filter: brightness(.95);
}

.aksi-btn svg {
    width: 17px;
    height: 17px;

    stroke: currentColor;
    fill: none;

    stroke-width: 1.8;
    stroke-linecap: round;
    stroke-linejoin: round;
}


/* LIHAT */

.aksi-lihat {
    background: #dbeafe;
    color: #1d4ed8;
}


/* EDIT */

.aksi-edit {
    background: #fef3c7;
    color: #b45309;
}


/* HAPUS */

.aksi-hapus {
    background: #fee2e2;
    color: #dc2626;
}


/* =====================================================
   PAGINATION
===================================================== */

.pengajuan-pagination {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    margin-top: 20px;
    padding-top: 18px;
    border-top: 1px solid #e2e8f0;
}

.pagination-info {
    color: #64748b;
    font-size: 12px;
}

.pagination-links {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
}

.pagination-links a,
.pagination-links span {
    min-width: 34px;
    height: 34px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 0 10px;

    border: 1px solid #e2e8f0;
    border-radius: 8px;

    background: #ffffff;
    color: #475569;

    font-size: 12px;
    font-weight: 700;

    text-decoration: none;

    transition:
        background .2s ease,
        color .2s ease,
        border-color .2s ease;
}

.pagination-links a:hover {
    background: #eff6ff;
    color: #2563eb;
    border-color: #bfdbfe;
}

.pagination-links .active {
    background: #2563eb;
    color: #ffffff;
    border-color: #2563eb;
}

.pagination-links .disabled {
    background: #f8fafc;
    color: #cbd5e1;
    border-color: #e2e8f0;
    cursor: not-allowed;
}


/* =====================================================
   MODAL
===================================================== */

.edit-modal {
    display: none;

    position: fixed;
    inset: 0;

    z-index: 9999;

    background: rgba(15, 23, 42, .55);

    align-items: center;
    justify-content: center;

    padding: 20px;

    overflow-y: auto;
}

.edit-modal.active {
    display: flex;
}


.edit-modal-box {
    width: 100%;
    max-width: 760px;

    max-height: 92vh;

    background: white;

    border-radius: 18px;

    overflow: hidden;

    box-shadow:
        0 25px 60px rgba(0,0,0,.25);

    animation: modalShow .2s ease;
}


@keyframes modalShow {

    from {
        opacity: 0;
        transform: translateY(-15px) scale(.98);
    }

    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

}


/* =====================================================
   MODAL HEADER
===================================================== */

.edit-modal-header {

    display: flex;

    align-items: center;
    justify-content: space-between;

    padding: 22px 28px;

    border-bottom: 1px solid #e2e8f0;
}

.edit-modal-header h2 {

    margin: 0;

    color: #1e3a8a;

    font-size: 24px;

    font-weight: 800;
}

.edit-modal-close {

    width: 44px;
    height: 44px;

    border: none;

    border-radius: 10px;

    background: #f1f5f9;

    color: #64748b;

    font-size: 25px;

    cursor: pointer;

    transition: .2s ease;
}

.edit-modal-close:hover {

    background: #e2e8f0;

    color: #0f172a;
}


/* =====================================================
   MODAL BODY
===================================================== */

.edit-modal-body {

    padding: 25px 28px;

    max-height: calc(92vh - 150px);

    overflow-y: auto;
}


/* =====================================================
   FORM
===================================================== */

.edit-form-group {

    margin-bottom: 20px;

}

.edit-form-group label {

    display: block;

    margin-bottom: 8px;

    color: #334155;

    font-size: 14px;

    font-weight: 700;
}

.edit-form-group label span {

    color: #dc2626;
}


.edit-form-group input,
.edit-form-group select,
.edit-form-group textarea {

    width: 100%;

    box-sizing: border-box;

    padding: 12px 14px;

    border: 1px solid #cbd5e1;

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


.edit-form-group input:focus,
.edit-form-group select:focus,
.edit-form-group textarea:focus {

    border-color: #2563eb;

    box-shadow:
        0 0 0 3px
        rgba(37,99,235,.10);
}


.edit-form-group textarea {

    min-height: 130px;

    resize: vertical;

    line-height: 1.6;
}


/* =====================================================
   MAP
===================================================== */

#editMap {

    width: 100%;

    height: 320px;

    margin-top: 10px;

    border: 1px solid #cbd5e1;

    border-radius: 10px;

    overflow: hidden;

    background: #e2e8f0;
}


.map-help {

    display: block;

    margin-top: 7px;

    color: #94a3b8;

    font-size: 11px;

    line-height: 1.5;
}


/* =====================================================
   FOOTER MODAL
===================================================== */

.edit-modal-footer {

    display: flex;

    align-items: center;

    justify-content: flex-end;

    gap: 10px;

    padding: 20px 28px;

    background: #f8fafc;

    border-top: 1px solid #e2e8f0;
}


.modal-btn {

    padding: 11px 20px;

    border: none;

    border-radius: 9px;

    font-family: inherit;

    font-size: 13px;

    font-weight: 700;

    cursor: pointer;

    transition: .2s ease;
}


.modal-btn-cancel {

    background: #e2e8f0;

    color: #334155;
}


.modal-btn-cancel:hover {

    background: #cbd5e1;
}


.modal-btn-save {

    background: #2563eb;

    color: white;
}


.modal-btn-save:hover {

    background: #1d4ed8;
}


/* =====================================================
   ERROR
===================================================== */

.modal-error {

    margin-bottom: 20px;

    padding: 14px 16px;

    background: #fef2f2;

    border: 1px solid #fecaca;

    border-radius: 9px;

    color: #991b1b;

    font-size: 13px;
}


/* =====================================================
   MOBILE
===================================================== */

@media (max-width: 700px) {

    .page-title {
        font-size: 24px;
    }

    .edit-modal {
        padding: 10px;
    }

    .edit-modal-box {
        max-height: 96vh;
        border-radius: 14px;
    }

    .edit-modal-header {
        padding: 18px 20px;
    }

    .edit-modal-header h2 {
        font-size: 20px;
    }

    .edit-modal-body {
        padding: 20px;
        max-height: calc(96vh - 145px);
    }

    .edit-modal-footer {
        padding: 15px 20px;
    }

    #editMap {
        height: 280px;
    }

    .aksi-column {
        width: 110px;
    }

    .aksi-btn {
        width: 30px;
        height: 30px;
    }

    .pengajuan-pagination {
        flex-direction: column;
        align-items: center;
    }

    .pagination-links {
        flex-wrap: wrap;
    }

}

</style>

@endsection


@section('content')


{{-- =====================================================
     HEADER
===================================================== --}}

<div class="page-header">

    <div>

        <h1 class="page-title">
            Pengajuan Saya
        </h1>

        <p class="page-description">
            Daftar pengaduan yang telah kamu ajukan.
        </p>

        <a
            href="{{ route('masyarakat.pengajuan.create') }}"
            class="btn btn-primary"
        >
            ＋ Buat Pengajuan
        </a>

    </div>

</div>


{{-- =====================================================
     DATA PENGAJUAN
===================================================== --}}

<div class="card">

    @if ($pengajuans->count())

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Judul</th>

                        <th>Kategori</th>

                        <th>Lokasi</th>

                        <th>Tanggal</th>

                        <th>Status</th>

                        <th class="aksi-column">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach ($pengajuans as $pengajuan)

                        <tr>

                            {{-- NO --}}

                            <td>
                                {{ $pengajuans->firstItem() + $loop->index }}
                            </td>


                            {{-- JUDUL --}}

                            <td>

                                <strong>
                                    {{ $pengajuan->judul }}
                                </strong>

                            </td>


                            {{-- KATEGORI --}}

                            <td>

                                {{ $pengajuan->kategori->nama_kategori ?? '-' }}

                            </td>


                            {{-- LOKASI --}}

                            <td>

                                {{ $pengajuan->lokasi }}

                            </td>


                            {{-- TANGGAL --}}

                            <td>

                                {{ $pengajuan->tanggal?->format('d-m-Y') }}

                            </td>


                            {{-- STATUS --}}

                            <td>

                                @if ($pengajuan->status === 'diajukan')

                                    <span class="badge badge-warning">
                                        Diajukan
                                    </span>

                                @elseif ($pengajuan->status === 'diproses')

                                    <span class="badge badge-info">
                                        Diproses
                                    </span>

                                @elseif ($pengajuan->status === 'selesai')

                                    <span class="badge badge-success">
                                        Selesai
                                    </span>

                                @elseif ($pengajuan->status === 'ditolak')

                                    <span class="badge badge-danger">
                                        Ditolak
                                    </span>

                                @else

                                    <span class="badge">
                                        {{ ucfirst($pengajuan->status) }}
                                    </span>

                                @endif

                            </td>


                            {{-- =================================================
                                 AKSI
                            ================================================== --}}

                            <td class="aksi-column">

                                <div class="aksi-buttons">


                                    {{-- LIHAT --}}

                                    <a
                                        href="{{ route(
                                            'masyarakat.pengajuan.show',
                                            $pengajuan->id_pengajuan
                                        ) }}"
                                        class="aksi-btn aksi-lihat"
                                        title="Lihat pengajuan"
                                        aria-label="Lihat pengajuan"
                                    >

                                        <svg viewBox="0 0 24 24">

                                            <path
                                                d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6z"
                                            />

                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="2.5"
                                            />

                                        </svg>

                                    </a>


                                    @if ($pengajuan->status === 'diajukan')


                                        {{-- =================================================
                                             EDIT
                                             TIDAK ADA href EDIT LAGI
                                             LANGSUNG BUKA MODAL
                                        ================================================== --}}

                                        <button
                                            type="button"
                                            class="aksi-btn aksi-edit btn-edit-pengajuan"

                                            title="Edit pengajuan"

                                            aria-label="Edit pengajuan"

                                            data-id="{{ $pengajuan->id_pengajuan }}"

                                            data-judul="{{ $pengajuan->judul }}"

                                            data-kategori="{{ $pengajuan->id_kategori }}"

                                            data-lokasi="{{ $pengajuan->lokasi }}"

                                            data-latitude="{{ $pengajuan->latitude }}"

                                            data-longitude="{{ $pengajuan->longitude }}"

                                            data-tanggal="{{ $pengajuan->tanggal?->format('Y-m-d') }}"

                                            data-keterangan="{{ $pengajuan->keterangan }}"
                                        >

                                            <svg viewBox="0 0 24 24">

                                                <path
                                                    d="M12 20h9"
                                                />

                                                <path
                                                    d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"
                                                />

                                            </svg>

                                        </button>


                                        {{-- =================================================
                                             HAPUS
                                        ================================================== --}}

                                        <form
                                            action="{{ route(
                                                'masyarakat.pengajuan.destroy',
                                                $pengajuan->id_pengajuan
                                            ) }}"
                                            method="POST"
                                            style="margin:0;"
                                            onsubmit="return confirm('Yakin ingin menghapus pengajuan ini?')"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="aksi-btn aksi-hapus"
                                                title="Hapus pengajuan"
                                                aria-label="Hapus pengajuan"
                                            >

                                                <svg viewBox="0 0 24 24">

                                                    <path
                                                        d="M3 6h18"
                                                    />

                                                    <path
                                                        d="M8 6V4h8v2"
                                                    />

                                                    <path
                                                        d="M19 6l-1 14H6L5 6"
                                                    />

                                                    <path
                                                        d="M10 11v5"
                                                    />

                                                    <path
                                                        d="M14 11v5"
                                                    />

                                                </svg>

                                            </button>

                                        </form>

                                    @endif


                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>


        {{-- =====================================================
             PAGINATION
        ====================================================== --}}

        @if ($pengajuans->hasPages())

            <div class="pengajuan-pagination">

                <div class="pagination-info">

                    Menampilkan
                    <strong>{{ $pengajuans->firstItem() }}</strong>
                    -
                    <strong>{{ $pengajuans->lastItem() }}</strong>
                    dari
                    <strong>{{ $pengajuans->total() }}</strong>
                    pengajuan

                </div>


                <div class="pagination-links">

                    {{-- SEBELUMNYA --}}

                    @if ($pengajuans->onFirstPage())

                        <span class="disabled">
                            ‹
                        </span>

                    @else

                        <a
                            href="{{ $pengajuans->previousPageUrl() }}"
                            aria-label="Halaman sebelumnya"
                        >
                            ‹
                        </a>

                    @endif


                    {{-- NOMOR HALAMAN --}}

                    @foreach ($pengajuans->getUrlRange(1, $pengajuans->lastPage()) as $page => $url)

                        @if ($page == $pengajuans->currentPage())

                            <span class="active">
                                {{ $page }}
                            </span>

                        @else

                            <a href="{{ $url }}">
                                {{ $page }}
                            </a>

                        @endif

                    @endforeach


                    {{-- BERIKUTNYA --}}

                    @if ($pengajuans->hasMorePages())

                        <a
                            href="{{ $pengajuans->nextPageUrl() }}"
                            aria-label="Halaman berikutnya"
                        >
                            ›
                        </a>

                    @else

                        <span class="disabled">
                            ›
                        </span>

                    @endif

                </div>

            </div>

        @endif


    @else


        {{-- EMPTY --}}

        <div class="empty">

            <div class="empty-icon">
                📭
            </div>

            <h3>
                Belum Ada Pengajuan
            </h3>

            <p>
                Kamu belum membuat pengajuan.
            </p>

        </div>

    @endif

</div>



{{-- =====================================================
     MODAL EDIT PENGAJUAN
===================================================== --}}

<div
    id="editPengajuanModal"
    class="edit-modal"
>


    <div class="edit-modal-box">


        {{-- =================================================
             HEADER
        ================================================== --}}

        <div class="edit-modal-header">

            <h2>
                Edit Pengajuan
            </h2>

            <button
                type="button"
                class="edit-modal-close"
                id="closeEditModal"
            >
                ×
            </button>

        </div>


        {{-- =================================================
             FORM
        ================================================== --}}

        <form
            id="editPengajuanForm"
            method="POST"
        >

            @csrf

            @method('PUT')


            {{-- =================================================
                 BODY
            ================================================== --}}

            <div class="edit-modal-body">


                {{-- JUDUL --}}

                <div class="edit-form-group">

                    <label for="edit_judul">

                        Judul Pengajuan

                        <span>*</span>

                    </label>

                    <input
                        type="text"
                        name="judul"
                        id="edit_judul"
                        required
                    >

                </div>


                {{-- KATEGORI --}}

                <div class="edit-form-group">

                    <label for="edit_id_kategori">

                        Kategori

                        <span>*</span>

                    </label>

                    <select
                        name="id_kategori"
                        id="edit_id_kategori"
                        required
                    >

                        <option value="">
                            -- Pilih Kategori --
                        </option>

                        @foreach ($kategoris as $kategori)

                            <option
                                value="{{ $kategori->id_kategori }}"
                            >
                                {{ $kategori->nama_kategori }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- LOKASI --}}

                <div class="edit-form-group">

                    <label for="edit_lokasi">

                        Lokasi Pengaduan

                        <span>*</span>

                    </label>

                    <input
                        type="text"
                        name="lokasi"
                        id="edit_lokasi"
                        readonly
                        required
                    >

                    <small class="map-help">
                        Klik pada peta untuk mengubah lokasi pengaduan.
                    </small>


                    {{-- MAP --}}

                    <div id="editMap"></div>


                    {{-- LATITUDE --}}

                    <input
                        type="hidden"
                        name="latitude"
                        id="edit_latitude"
                    >


                    {{-- LONGITUDE --}}

                    <input
                        type="hidden"
                        name="longitude"
                        id="edit_longitude"
                    >

                </div>


                {{-- TANGGAL --}}

                <div class="edit-form-group">

                    <label for="edit_tanggal">

                        Tanggal Pengajuan

                        <span>*</span>

                    </label>

                    <input
                        type="date"
                        name="tanggal"
                        id="edit_tanggal"
                        required
                    >

                </div>


                {{-- KETERANGAN --}}

                <div class="edit-form-group">

                    <label for="edit_keterangan">

                        Isi Pengaduan

                        <span>*</span>

                    </label>

                    <textarea
                        name="keterangan"
                        id="edit_keterangan"
                        rows="6"
                        required
                    ></textarea>

                </div>

            </div>


            {{-- =================================================
                 FOOTER
            ================================================== --}}

            <div class="edit-modal-footer">

                <button
                    type="button"
                    class="modal-btn modal-btn-cancel"
                    id="cancelEditModal"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="modal-btn modal-btn-save"
                >
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>



{{-- =====================================================
     LEAFLET CSS
===================================================== --}}

<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
/>


{{-- =====================================================
     LEAFLET JS
===================================================== --}}

<script
    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
</script>


<script>

document.addEventListener('DOMContentLoaded', function () {


    /* =====================================================
       ELEMENT
    ===================================================== */

    const modal =
        document.getElementById('editPengajuanModal');

    const form =
        document.getElementById('editPengajuanForm');

    const closeButton =
        document.getElementById('closeEditModal');

    const cancelButton =
        document.getElementById('cancelEditModal');


    const judulInput =
        document.getElementById('edit_judul');

    const kategoriInput =
        document.getElementById('edit_id_kategori');

    const lokasiInput =
        document.getElementById('edit_lokasi');

    const latitudeInput =
        document.getElementById('edit_latitude');

    const longitudeInput =
        document.getElementById('edit_longitude');

    const tanggalInput =
        document.getElementById('edit_tanggal');

    const keteranganInput =
        document.getElementById('edit_keterangan');


    /* =====================================================
       MAP
    ===================================================== */

    let map = null;

    let marker = null;


    /* =====================================================
       BUKA MODAL
    ===================================================== */

    document
        .querySelectorAll('.btn-edit-pengajuan')
        .forEach(function (button) {


            button.addEventListener('click', function () {


                const id =
                    this.dataset.id;

                const judul =
                    this.dataset.judul;

                const kategori =
                    this.dataset.kategori;

                const lokasi =
                    this.dataset.lokasi;

                const latitude =
                    parseFloat(this.dataset.latitude);

                const longitude =
                    parseFloat(this.dataset.longitude);

                const tanggal =
                    this.dataset.tanggal;

                const keterangan =
                    this.dataset.keterangan;


                /* ==========================================
                   ISI FORM
                ========================================== */

                judulInput.value =
                    judul || '';

                kategoriInput.value =
                    kategori || '';

                lokasiInput.value =
                    lokasi || '';

                latitudeInput.value =
                    !isNaN(latitude)
                        ? latitude
                        : '';

                longitudeInput.value =
                    !isNaN(longitude)
                        ? longitude
                        : '';

                tanggalInput.value =
                    tanggal || '';

                keteranganInput.value =
                    keterangan || '';


                /* ==========================================
                   ACTION FORM

                   /pengajuan/{id}
                ========================================== */

                form.action =
                    '/pengajuan/' + id;


                /* ==========================================
                   TAMPILKAN MODAL
                ========================================== */

                modal.classList.add('active');

                document.body.style.overflow =
                    'hidden';


                /* ==========================================
                   MAP
                ========================================== */

                let lat =
                    !isNaN(latitude)
                        ? latitude
                        : -0.217;

                let lng =
                    !isNaN(longitude)
                        ? longitude
                        : 100.600;


                setTimeout(function () {


                    /* ==============================
                       BUAT MAP JIKA BELUM ADA
                    ============================== */

                    if (!map) {

                        map =
                            L.map('editMap', {

                                center: [
                                    lat,
                                    lng
                                ],

                                zoom: 16,

                                zoomControl: true

                            });


                        L.tileLayer(
                            'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                            {

                                maxZoom: 19,

                                attribution:
                                    '&copy; OpenStreetMap contributors'

                            }
                        ).addTo(map);


                    } else {

                        map.invalidateSize();

                    }


                    /* ==============================
                       HAPUS MARKER LAMA
                    ============================== */

                    if (marker) {

                        map.removeLayer(marker);

                    }


                    /* ==============================
                       MARKER BARU
                    ============================== */

                    marker =
                        L.marker([
                            lat,
                            lng
                        ])
                        .addTo(map);


                    marker.bindPopup(
                        '<b>Lokasi Pengaduan</b><br>' +
                        'Latitude: ' +
                        lat +
                        '<br>' +
                        'Longitude: ' +
                        lng
                    );


                    map.setView(
                        [
                            lat,
                            lng
                        ],
                        16
                    );


                }, 250);

            });

        });


    /* =====================================================
       KLIK MAP
    ===================================================== */

    function setupMapClick() {

        if (!map) {
            return;
        }


        map.off('click');


        map.on('click', function (e) {


            const newLatitude =
                e.latlng.lat.toFixed(7);

            const newLongitude =
                e.latlng.lng.toFixed(7);


            /* ==============================
               UPDATE INPUT
            ============================== */

            latitudeInput.value =
                newLatitude;

            longitudeInput.value =
                newLongitude;


            lokasiInput.value =
                'Latitude: ' +
                newLatitude +
                ', Longitude: ' +
                newLongitude;


            /* ==============================
               HAPUS MARKER
            ============================== */

            if (marker) {

                map.removeLayer(marker);

            }


            /* ==============================
               MARKER BARU
            ============================== */

            marker =
                L.marker([
                    e.latlng.lat,
                    e.latlng.lng
                ])
                .addTo(map);


            marker.bindPopup(

                '<b>Lokasi Pengaduan</b><br>' +

                'Latitude: ' +
                newLatitude +

                '<br>' +

                'Longitude: ' +
                newLongitude

            ).openPopup();

        });

    }


    /* =====================================================
       AKTIFKAN MAP CLICK
    ===================================================== */

    document
        .querySelectorAll('.btn-edit-pengajuan')
        .forEach(function (button) {

            button.addEventListener(
                'click',
                function () {

                    setTimeout(function () {

                        setupMapClick();

                    }, 350);

                }
            );

        });


    /* =====================================================
       TUTUP MODAL
    ===================================================== */

    function closeModal() {

        modal.classList.remove('active');

        document.body.style.overflow =
            '';

    }


    closeButton.addEventListener(
        'click',
        closeModal
    );


    cancelButton.addEventListener(
        'click',
        closeModal
    );


    /* =====================================================
       KLIK AREA LUAR MODAL
    ===================================================== */

    modal.addEventListener(
        'click',
        function (e) {

            if (e.target === modal) {

                closeModal();

            }

        }
    );


    /* =====================================================
       ESCAPE
    ===================================================== */

    document.addEventListener(
        'keydown',
        function (e) {

            if (
                e.key === 'Escape' &&
                modal.classList.contains('active')
            ) {

                closeModal();

            }

        }
    );


});

</script>

@endsection