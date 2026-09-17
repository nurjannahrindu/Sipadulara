@extends('layouts.admin')

@section('title', 'Detail Pengajuan')

@section('content')

<style>

    /* =====================================================
       HEADER
    ===================================================== */

    .detail-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 20px;
    }

    .detail-header h1 {
        margin: 0;
        color: #0f172a;
        font-size: 28px;
        font-weight: 800;
    }

    .detail-header p {
        margin: 7px 0 0;
        color: #64748b;
        font-size: 13px;
    }


    /* =====================================================
       CARD
    ===================================================== */

    .detail-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 20px;
        box-shadow: 0 5px 18px rgba(15, 23, 42, .04);
    }

    .detail-card h2 {
        margin: 0 0 20px;
        color: #1e3a8a;
        font-size: 20px;
        font-weight: 800;
    }


    /* =====================================================
       BACK BUTTON
    ===================================================== */

    .back-button {
        width: 48px;
        height: 48px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background: #1e3a8a;
        color: white;

        text-decoration: none;

        box-shadow: 0 3px 8px rgba(0, 0, 0, .20);

        transition: all .2s ease;
    }

    .back-button:hover {
        background: #1e40af;
        transform: translateX(-2px);
    }


    /* =====================================================
       DETAIL TABLE
    ===================================================== */

    .detail-table {
        width: 100%;
        border-collapse: collapse;
    }

    .detail-table th,
    .detail-table td {
        padding: 14px 12px;
        border-bottom: 1px solid #e5e7eb;
        vertical-align: top;
    }

    .detail-table tr:last-child th,
    .detail-table tr:last-child td {
        border-bottom: none;
    }

    .detail-table th {
        width: 200px;
        color: #475569;
        font-size: 13px;
        font-weight: 700;
        text-align: left;
    }

    .detail-table td {
        color: #334155;
        font-size: 14px;
        line-height: 1.6;
    }


    /* =====================================================
       STATUS BADGE
    ===================================================== */

    .status-badge {
        display: inline-flex;
        align-items: center;

        padding: 6px 12px;

        border-radius: 20px;

        font-size: 12px;
        font-weight: 700;
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


    /* =====================================================
       IMAGE
    ===================================================== */

    .image-section {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
    }

    .image-label {
        display: block;
        margin-bottom: 10px;

        color: #334155;

        font-size: 13px;
        font-weight: 700;
    }

    .pengajuan-image {
        display: block;

        width: 100%;
        max-width: 500px;
        max-height: 400px;

        object-fit: contain;

        padding: 5px;

        background: #f8fafc;

        border: 1px solid #e2e8f0;
        border-radius: 10px;
    }


    /* =====================================================
       PENANGANAN INFO
    ===================================================== */

    .handling-info {
        background: #eff6ff;

        border: 1px solid #bfdbfe;

        border-radius: 12px;

        padding: 18px;

        margin-bottom: 15px;
    }

    .handling-info h3 {
        margin: 0 0 8px;

        color: #1e3a8a;

        font-size: 16px;
    }

    .handling-info p {
        margin: 0 0 14px;

        color: #475569;

        font-size: 13px;
        line-height: 1.6;
    }


    /* =====================================================
       RIWAYAT PENANGANAN
    ===================================================== */

    .handling-item {
        border: 1px solid #e5e7eb;

        border-radius: 12px;

        padding: 20px;

        margin-bottom: 15px;

        background: #ffffff;

        transition: all .2s ease;
    }

    .handling-item:hover {
        border-color: #cbd5e1;

        box-shadow:
            0 5px 15px rgba(15, 23, 42, .05);
    }

    .handling-item:last-child {
        margin-bottom: 0;
    }

    .handling-top {
        display: flex;

        justify-content: space-between;

        align-items: center;

        gap: 10px;

        margin-bottom: 15px;
    }

    .handling-date {
        color: #64748b;

        font-size: 12px;
    }

    .handling-detail {
        margin-bottom: 14px;
    }

    .handling-label {
        display: block;

        margin-bottom: 5px;

        color: #64748b;

        font-size: 12px;

        font-weight: 700;
    }

    .handling-value {
        color: #334155;

        font-size: 14px;

        line-height: 1.6;
    }

    .handling-image {
        display: block;

        width: 100%;
        max-width: 400px;
        max-height: 300px;

        object-fit: contain;

        padding: 5px;

        background: #f8fafc;

        border: 1px solid #e2e8f0;

        border-radius: 10px;
    }


    /* =====================================================
       BUTTON
    ===================================================== */

    .action-buttons {
        display: flex;

        gap: 10px;

        align-items: center;

        flex-wrap: wrap;
    }

    .edit-button {
        display: inline-flex;

        align-items: center;

        justify-content: center;

        min-height: 40px;

        padding: 9px 15px;

        border: none;

        border-radius: 9px;

        background: #f59e0b;

        color: #ffffff;

        font-size: 13px;

        font-weight: 700;

        cursor: pointer;

        transition: all .2s ease;
    }

    .edit-button:hover {
        background: #d97706;
        transform: translateY(-1px);
    }


    /* =====================================================
       MODAL
    ===================================================== */

    #editPenangananModal {
        display: none;

        position: fixed;

        inset: 0;

        background: rgba(15, 23, 42, .60);

        z-index: 9999;

        align-items: center;

        justify-content: center;

        padding: 20px;
    }

    .modal-box {
        width: 100%;

        max-width: 700px;

        max-height: 90vh;

        overflow-y: auto;

        background: #ffffff;

        border-radius: 16px;

        box-shadow:
            0 25px 60px rgba(0, 0, 0, .25);

        animation: modalOpen .2s ease;
    }

    @keyframes modalOpen {

        from {
            opacity: 0;
            transform: translateY(10px) scale(.98);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

    }


    /* =====================================================
       MODAL HEADER
    ===================================================== */

    .modal-header {
        display: flex;

        justify-content: space-between;

        align-items: center;

        gap: 15px;

        padding: 20px 24px;

        border-bottom: 1px solid #e5e7eb;
    }

    .modal-header h2 {
        margin: 0;

        color: #0f172a;

        font-size: 20px;

        font-weight: 800;
    }

    .modal-header p {
        margin: 5px 0 0;

        color: #64748b;

        font-size: 13px;
    }

    .modal-close {
        width: 38px;
        height: 38px;

        border: none;

        border-radius: 50%;

        background: #f1f5f9;

        color: #475569;

        font-size: 22px;

        cursor: pointer;

        transition: all .2s ease;
    }

    .modal-close:hover {
        background: #e2e8f0;

        color: #0f172a;
    }


    /* =====================================================
       FORM
    ===================================================== */

    .modal-body {
        padding: 24px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;

        margin-bottom: 7px;

        color: #334155;

        font-size: 13px;

        font-weight: 700;
    }

    .form-control {
        width: 100%;

        min-height: 44px;

        padding: 10px 13px;

        border: 1px solid #cbd5e1;

        border-radius: 9px;

        background: #ffffff;

        color: #334155;

        font-family: inherit;

        font-size: 13px;

        outline: none;

        transition: .2s ease;

        box-sizing: border-box;
    }

    .form-control:focus {
        border-color: #2563eb;

        box-shadow:
            0 0 0 3px rgba(37, 99, 235, .10);
    }

    textarea.form-control {
        min-height: 130px;

        resize: vertical;
    }

    .form-help {
        display: block;

        margin-top: 7px;

        color: #64748b;

        font-size: 11px;

        line-height: 1.5;
    }


    /* =====================================================
       FOTO LAMA
    ===================================================== */

    #editFotoLamaContainer {
        display: none;

        margin-bottom: 20px;
    }

    .old-photo {
        display: block;

        width: 100%;

        max-width: 400px;

        max-height: 300px;

        object-fit: contain;

        padding: 5px;

        background: #f8fafc;

        border: 1px solid #e2e8f0;

        border-radius: 10px;
    }


    /* =====================================================
       PREVIEW FOTO BARU
    ===================================================== */

    #editPreviewContainer {
        display: none;

        margin-top: 12px;
    }

    .preview-title {
        margin-bottom: 8px;

        color: #64748b;

        font-size: 12px;

        font-weight: 600;
    }

    #editPreviewImage {
        display: block;

        width: 100%;

        max-width: 400px;

        max-height: 300px;

        object-fit: contain;

        padding: 5px;

        background: #f8fafc;

        border: 1px solid #cbd5e1;

        border-radius: 10px;
    }


    /* =====================================================
       MODAL ACTIONS
    ===================================================== */

    .modal-actions {
        display: flex;

        justify-content: flex-end;

        gap: 10px;

        padding-top: 5px;
    }

    .cancel-button {
        display: inline-flex;

        align-items: center;

        justify-content: center;

        min-height: 40px;

        padding: 9px 16px;

        border: none;

        border-radius: 9px;

        background: #e2e8f0;

        color: #334155;

        font-size: 13px;

        font-weight: 600;

        cursor: pointer;
    }

    .cancel-button:hover {
        background: #cbd5e1;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 700px) {

        .detail-header {
            align-items: flex-start;
        }

        .detail-header h1 {
            font-size: 23px;
        }

        .detail-card {
            padding: 18px;
        }

        .detail-table th {
            width: 130px;
        }

        .detail-table th,
        .detail-table td {
            padding: 11px 8px;
        }

        .handling-top {
            align-items: flex-start;

            flex-direction: column;
        }

        .modal-box {
            max-height: 95vh;
        }

        .modal-header,
        .modal-body {
            padding: 18px;
        }

        .modal-actions {
            flex-direction: column-reverse;
        }

        .modal-actions button {
            width: 100%;
        }

    }

</style>


{{-- =====================================================
     HEADER
===================================================== --}}

<div class="detail-header">

    <div>

        <h1>
            Detail Pengajuan
        </h1>

        <p>
            Informasi lengkap pengajuan masyarakat.
        </p>

    </div>


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

</div>


{{-- =====================================================
     SUCCESS MESSAGE
===================================================== --}}

@if (session('success'))

    <div
        class="detail-card"
        style="
            margin-bottom:20px;
            border-left:5px solid #16a34a;
            background:#f0fdf4;
        "
    >

        <strong style="color:#166534;">

            ✓ {{ session('success') }}

        </strong>

    </div>

@endif


{{-- =====================================================
     ERROR MESSAGE
===================================================== --}}

@if (session('error'))

    <div
        class="detail-card"
        style="
            margin-bottom:20px;
            border-left:5px solid #dc2626;
            background:#fef2f2;
        "
    >

        <strong style="color:#991b1b;">

            {{ session('error') }}

        </strong>

    </div>

@endif


{{-- =====================================================
     DETAIL PENGAJUAN
===================================================== --}}

<div class="detail-card">

    <h2>
        Informasi Pengajuan
    </h2>


    <table class="detail-table">

        <tr>

            <th>
                Masyarakat
            </th>

            <td>
                {{ $pengajuan->masyarakat->nama }}
            </td>

        </tr>


        <tr>

            <th>
                Kategori
            </th>

            <td>
                {{ $pengajuan->kategori->nama_kategori }}
            </td>

        </tr>


        <tr>

            <th>
                Judul
            </th>

            <td>
                {{ $pengajuan->judul }}
            </td>

        </tr>


        <tr>

            <th>
                Keterangan
            </th>

            <td>
                {{ $pengajuan->keterangan }}
            </td>

        </tr>


        {{-- =================================================
             LOKASI
        ================================================== --}}

        <tr>

            <th>
                Lokasi
            </th>

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


                @if ($latitude !== null && $longitude !== null)

                    <div style="margin-top:15px;">

                        <strong>
                            Lokasi pada Peta:
                        </strong>


                        <div
                            style="
                                margin-top:10px;
                                border-radius:10px;
                                overflow:hidden;
                                border:1px solid #ddd;
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


                        <p style="margin-top:10px;">

                            <a
                                href="https://www.google.com/maps?q={{ $latitude }},{{ $longitude }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="btn btn-primary"
                            >
                                📍 Buka di Google Maps
                            </a>

                        </p>

                    </div>

                @endif

            </td>

        </tr>


        {{-- =================================================
             TANGGAL
        ================================================== --}}

        <tr>

            <th>
                Tanggal Pengajuan
            </th>

            <td>

                {{ $pengajuan->tanggal
                    ? \Carbon\Carbon::parse($pengajuan->tanggal)->format('d-m-Y')
                    : '-'
                }}

            </td>

        </tr>


        {{-- =================================================
             STATUS
        ================================================== --}}

        <tr>

            <th>
                Status
            </th>

            <td>

                @if ($pengajuan->status === 'diajukan')

                    <span class="status-badge status-diajukan">
                        Diajukan
                    </span>

                @elseif ($pengajuan->status === 'diproses')

                    <span class="status-badge status-diproses">
                        Diproses
                    </span>
                @elseif ($pengajuan->status === 'selesai')

                    <span class="status-badge status-selesai">
                        Selesai
                    </span>

                @elseif ($pengajuan->status === 'ditolak')

                    <span class="status-badge status-ditolak">
                        Ditolak
                    </span>

                @else

                    <span class="status-badge">
                        {{ ucfirst($pengajuan->status) }}
                    </span>

                @endif

            </td>

        </tr>

    </table>


    {{-- =================================================
         GAMBAR PENGAJUAN
    ================================================== --}}

    @if ($pengajuan->gambar)

        <div class="image-section">

            <span class="image-label">
                Gambar Pengaduan
            </span>


            <img
                src="{{ asset('storage/' . $pengajuan->gambar) }}"
                alt="Gambar Pengaduan"
                class="pengajuan-image"
            >

        </div>

    @endif

</div>


{{-- =====================================================
     TOMBOL PENANGANAN
===================================================== --}}

@if (
    $pengajuan->status !== 'selesai' &&
    $pengajuan->status !== 'ditolak'
)

    <div class="detail-card">

        <h2>
            Penanganan
        </h2>


        <div class="handling-info">
            <p>
                Admin dapat memberikan tindakan, memperbarui status,
                serta menambahkan keterangan dan foto penanganan.
            </p>


            <a
                href="{{ route('admin.penanganan.create', $pengajuan->id_pengajuan) }}"
                class="btn btn-primary"
            >
                + Tangani Pengajuan
            </a>

        </div>

    </div>

@endif


{{-- =====================================================
     RIWAYAT PENANGANAN
===================================================== --}}

<div class="detail-card">

    <h2>
        Riwayat Penanganan
    </h2>


    @if ($pengajuan->penanganans->count() > 0)

        @foreach ($pengajuan->penanganans as $penanganan)

            <div class="handling-item">

                {{-- =================================================
                     HEADER RIWAYAT
                ================================================== --}}

                <div class="handling-top">

                    <div>

                        <span
                            style="
                                display:block;
                                margin-bottom:6px;
                                color:#64748b;
                                font-size:12px;
                                font-weight:700;
                            "
                        >
                            STATUS PENANGANAN
                        </span>


                        @if ($penanganan->status === 'diproses')

                            <span class="status-badge status-diproses">
                                Diproses
                            </span>

                        @elseif ($penanganan->status === 'selesai')

                            <span class="status-badge status-selesai">
                                Selesai
                            </span>

                        @elseif ($penanganan->status === 'ditolak')

                            <span class="status-badge status-ditolak">
                                Ditolak
                            </span>

                        @else

                            <span class="status-badge">
                                {{ ucfirst($penanganan->status) }}
                            </span>

                        @endif

                    </div>


                    <div class="handling-date">

                        {{ $penanganan->tanggal_penanganan
                            ? \Carbon\Carbon::parse($penanganan->tanggal_penanganan)->format('d-m-Y')
                            : '-'
                        }}

                    </div>

                </div>


                {{-- =================================================
                     ADMIN
                ================================================== --}}

                <div class="handling-detail">

                    <span class="handling-label">
                        Admin
                    </span>

                    <div class="handling-value">

                        {{ $penanganan->admin->nama ?? '-' }}

                    </div>

                </div>


                {{-- =================================================
                     KETERANGAN
                ================================================== --}}

                <div class="handling-detail">

                    <span class="handling-label">
                        Keterangan Penanganan
                    </span>

                    <div class="handling-value">

                        {{ $penanganan->keterangan ?? '-' }}

                    </div>

                </div>


                {{-- =================================================
                     FOTO PENANGANAN
                ================================================== --}}

                @if ($penanganan->gambar)

                    <div class="handling-detail">

                        <span class="handling-label">
                            Foto Penanganan
                        </span>


                        <img
                            src="{{ asset('storage/' . $penanganan->gambar) }}"
                            alt="Foto Penanganan"
                            class="handling-image"
                        >

                    </div>

                @endif


                {{-- =================================================
                     BUTTON EDIT
                ================================================== --}}

                <div
                    class="action-buttons"
                    style="margin-top:18px;"
                >

                    <button
                        type="button"
                        class="edit-button"
                        onclick="openEditPenanganan(
                            {{ $penanganan->id_penanganan }},
                            @js($penanganan->status),
                            @js(
                                $penanganan->tanggal_penanganan
                                    ? \Carbon\Carbon::parse($penanganan->tanggal_penanganan)->format('Y-m-d')
                                    : ''
                            ),
                            @js($penanganan->keterangan ?? ''),
                            @js($penanganan->gambar ?? '')
                        )"
                    >
                        ✎ Edit Penanganan
                    </button>

                </div>

            </div>

        @endforeach

    @else

        <div
            style="
                padding:25px;
                text-align:center;
                background:#f8fafc;
                border:1px dashed #cbd5e1;
                border-radius:10px;
            "
        >

            <div
                style="
                    font-size:30px;
                    margin-bottom:8px;
                "
            >
                📋
            </div>

            <strong
                style="
                    display:block;
                    color:#475569;
                    margin-bottom:5px;
                "
            >
                Belum Ada Penanganan
            </strong>

            <span
                style="
                    color:#64748b;
                    font-size:13px;
                "
            >
                Pengajuan ini belum memiliki riwayat penanganan.
            </span>

        </div>

    @endif

</div>



{{-- =====================================================
     MODAL EDIT PENANGANAN
===================================================== --}}

<div
    id="editPenangananModal"
    onclick="handleModalOutsideClick(event)"
>

    <div
        class="modal-box"
        onclick="event.stopPropagation()"
    >

        {{-- =================================================
             MODAL HEADER
        ================================================== --}}

        <div class="modal-header">

            <div>

                <h2>
                    Edit Penanganan
                </h2>

                <p>
                    Perbarui informasi penanganan pengajuan.
                </p>

            </div>


            <button
                type="button"
                class="modal-close"
                onclick="closeEditPenanganan()"
                title="Tutup"
            >
                ×
            </button>

        </div>


        {{-- =================================================
             FORM EDIT
        ================================================== --}}

        <form
            id="editPenangananForm"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            @method('PUT')


            <div class="modal-body">


                {{-- =================================================
                     STATUS
                ================================================== --}}

                <div class="form-group">

                    <label
                        for="edit_status"
                        class="form-label"
                    >
                        Status Penanganan
                    </label>


                    <select
                        name="status"
                        id="edit_status"
                        class="form-control"
                        required
                    >

                        <option value="diproses">
                            Diproses
                        </option>

                        <option value="selesai">
                            Selesai
                        </option>

                        <option value="ditolak">
                            Ditolak
                        </option>

                    </select>

                </div>


                {{-- =================================================
                     TANGGAL
                ================================================== --}}

                <div class="form-group">

                    <label
                        for="edit_tanggal_penanganan"
                        class="form-label"
                    >
                        Tanggal Penanganan
                    </label>


                    <input
                        type="date"
                        name="tanggal_penanganan"
                        id="edit_tanggal_penanganan"
                        class="form-control"
                        required
                    >

                </div>


                {{-- =================================================
                     KETERANGAN
                ================================================== --}}

                <div class="form-group">

                    <label
                        for="edit_keterangan"
                        class="form-label"
                    >
                        Keterangan Penanganan
                    </label>


                    <textarea
                        name="keterangan"
                        id="edit_keterangan"
                        class="form-control"
                        rows="5"
                        placeholder="Masukkan keterangan penanganan..."
                    ></textarea>

                </div>


                {{-- =================================================
                     FOTO LAMA
                ================================================== --}}

                <div
                    id="editFotoLamaContainer"
                >

                    <label
                        class="form-label"
                    >
                        Foto Penanganan Saat Ini
                    </label>


                    <img
                        id="editFotoLama"
                        src=""
                        alt="Foto Penanganan Saat Ini"
                        class="old-photo"
                    >

                </div>


                {{-- =================================================
                     FOTO BARU
                ================================================== --}}

                <div class="form-group">

                    <label
                        for="edit_gambar"
                        class="form-label"
                    >
                        Ganti Foto Penanganan
                    </label>


                    <input
                        type="file"
                        name="gambar"
                        id="edit_gambar"
                        class="form-control"
                        accept="image/jpeg,image/png,image/webp"
                    >


                    <small class="form-help">

                        Kosongkan jika tidak ingin mengganti foto.

                        <br>

                        Format JPG, JPEG, PNG, atau WEBP.
                        Maksimal 2 MB.

                    </small>


                    {{-- =================================================
                         PREVIEW FOTO BARU
                    ================================================== --}}

                    <div
                        id="editPreviewContainer"
                    >

                        <div class="preview-title">
                            Preview Foto Baru
                        </div>


                        <img
                            id="editPreviewImage"
                            src=""
                            alt="Preview Foto Baru"
                        >

                    </div>

                </div>


                {{-- =================================================
                     BUTTON
                ================================================== --}}

                <div class="modal-actions">

                    <button
                        type="button"
                        class="cancel-button"
                        onclick="closeEditPenanganan()"
                    >
                        Batal
                    </button>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        ✓ Simpan Perubahan
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>


@endsection



{{-- =====================================================
     JAVASCRIPT
===================================================== --}}

@section('scripts')

<script>

    /*
    |--------------------------------------------------------------------------
    | BUKA MODAL EDIT
    |--------------------------------------------------------------------------
    */

    function openEditPenanganan(
        id,
        status,
        tanggal,
        keterangan,
        gambar
    ) {

        const modal =
            document.getElementById(
                'editPenangananModal'
            );


        const form =
            document.getElementById(
                'editPenangananForm'
            );


        const statusInput =
            document.getElementById(
                'edit_status'
            );


        const tanggalInput =
            document.getElementById(
                'edit_tanggal_penanganan'
            );


        const keteranganInput =
            document.getElementById(
                'edit_keterangan'
            );


        const fotoLamaContainer =
            document.getElementById(
                'editFotoLamaContainer'
            );


        const fotoLama =
            document.getElementById(
                'editFotoLama'
            );


        const gambarInput =
            document.getElementById(
                'edit_gambar'
            );


        const previewContainer =
            document.getElementById(
                'editPreviewContainer'
            );


        const previewImage =
            document.getElementById(
                'editPreviewImage'
            );


        /*
        |--------------------------------------------------------------------------
        | SET ACTION FORM
        |--------------------------------------------------------------------------
        */

        form.action =
            "{{ url('/admin/penanganan') }}/"
            + id;


        /*
        |--------------------------------------------------------------------------
        | ISI DATA LAMA
        |--------------------------------------------------------------------------
        */

        statusInput.value =
            status || 'diproses';


        tanggalInput.value =
            tanggal || '';


        keteranganInput.value =
            keterangan || '';


        /*
        |--------------------------------------------------------------------------
        | RESET FOTO BARU
        |--------------------------------------------------------------------------
        */

        gambarInput.value = '';

        previewContainer.style.display =
            'none';

        previewImage.src =
            '';


        /*
        |--------------------------------------------------------------------------
        | FOTO LAMA
        |--------------------------------------------------------------------------
        */

        if (gambar) {

            fotoLama.src =
                "{{ asset('storage') }}/"
                + gambar;

            fotoLamaContainer.style.display =
                'block';

        } else {

            fotoLama.src = '';

            fotoLamaContainer.style.display =
                'none';

        }


        /*
        |--------------------------------------------------------------------------
        | TAMPILKAN MODAL
        |--------------------------------------------------------------------------
        */

        modal.style.display =
            'flex';


        /*
        |--------------------------------------------------------------------------
        | LOCK SCROLL BODY
        |--------------------------------------------------------------------------
        */

        document.body.style.overflow =
            'hidden';

    }


    /*
    |--------------------------------------------------------------------------
    | TUTUP MODAL
    |--------------------------------------------------------------------------
    */

    function closeEditPenanganan() {

        const modal =
            document.getElementById(
                'editPenangananModal'
            );


        modal.style.display =
            'none';


        document.body.style.overflow =
            '';

    }


    /*
    |--------------------------------------------------------------------------
    | KLIK AREA LUAR MODAL
    |--------------------------------------------------------------------------
    */

    function handleModalOutsideClick(event) {

        if (
            event.target.id ===
            'editPenangananModal'
        ) {

            closeEditPenanganan();

        }

    }


    /*
    |--------------------------------------------------------------------------
    | PREVIEW FOTO BARU
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const gambarInput =
                document.getElementById(
                    'edit_gambar'
                );


            const previewContainer =
                document.getElementById(
                    'editPreviewContainer'
                );


            const previewImage =
                document.getElementById(
                    'editPreviewImage'
                );


            if (
                !gambarInput ||
                !previewContainer ||
                !previewImage
            ) {

                return;

            }


            gambarInput.addEventListener(
                'change',
                function () {

                    const file =
                        this.files[0];


                    /*
                    |--------------------------------------------------------------------------
                    | JIKA TIDAK ADA FILE
                    |--------------------------------------------------------------------------
                    */

                    if (!file) {

                        previewContainer.style.display =
                            'none';

                        previewImage.src =
                            '';

                        return;

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | CEK TIPE FILE
                    |--------------------------------------------------------------------------
                    */

                    if (
                        !file.type.startsWith(
                            'image/'
                        )
                    ) {

                        this.value = '';

                        previewContainer.style.display =
                            'none';

                        previewImage.src =
                            '';

                        alert(
                            'File yang dipilih harus berupa gambar.'
                        );

                        return;

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | CEK UKURAN FILE
                    |--------------------------------------------------------------------------
                    */

                    if (
                        file.size >
                        2 * 1024 * 1024
                    ) {

                        this.value = '';

                        previewContainer.style.display =
                            'none';

                        previewImage.src =
                            '';

                        alert(
                            'Ukuran foto maksimal 2 MB.'
                        );

                        return;

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | BACA FILE
                    |--------------------------------------------------------------------------
                    */

                    const reader =
                        new FileReader();


                    reader.onload =
                        function (event) {

                            previewImage.src =
                                event.target.result;

                            previewContainer.style.display =
                                'block';

                        };


                    reader.readAsDataURL(
                        file
                    );

                }
            );

        }
    );


    /*
    |--------------------------------------------------------------------------
    | ESC UNTUK MENUTUP MODAL
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape'
            ) {

                const modal =
                    document.getElementById(
                        'editPenangananModal'
                    );


                if (
                    modal &&
                    modal.style.display === 'flex'
                ) {

                    closeEditPenanganan();

                }

            }

        }
    );

</script>

@endsection