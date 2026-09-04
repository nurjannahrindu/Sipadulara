@extends('layouts.admin')

@section('title', 'Penanganan Pengajuan')

@section('styles')

<style>
    /* =====================================================
       HALAMAN PENANGANAN PENGAJUAN
       CSS KHUSUS HALAMAN INI SAJA
    ===================================================== */

    .penanganan-wrapper {
        width: 100%;
    }

    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 20px;
    }

    .page-header h3 {
        margin: 0;
        color: #1e3a8a;
        font-size: 20px;
        font-weight: 700;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #2563eb;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    .back-link:hover {
        color: #1d4ed8;
    }


    /* =====================================================
       DATA PENGAJUAN
    ===================================================== */

    .pengajuan-card {
        background: white;
        border: 1px solid #e5eaf1;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 20px;

        box-shadow:
            0 5px 18px rgba(15,23,42,.04);
    }

    .section-title {
        margin: 0 0 20px;
        color: #1e3a8a;
        font-size: 17px;
        font-weight: 700;
    }

    .data-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px 25px;
    }

    .data-item {
        padding: 14px 16px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
    }

    .data-item.full {
        grid-column: 1 / -1;
    }

    .data-label {
        display: block;
        margin-bottom: 6px;
        color: #64748b;
        font-size: 12px;
        font-weight: 600;
    }

    .data-value {
        color: #334155;
        font-size: 14px;
        line-height: 1.6;
        word-break: break-word;
    }


    /* =====================================================
       GAMBAR PENGAJUAN
    ===================================================== */

    .gambar-pengajuan {
        margin-top: 20px;
    }

    .gambar-pengajuan-label {
        display: block;
        margin-bottom: 10px;
        color: #64748b;
        font-size: 12px;
        font-weight: 600;
    }

    .gambar-pengajuan img {
        display: block;
        width: 100%;
        max-width: 500px;
        max-height: 350px;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
    }


    /* =====================================================
       FORM PENANGANAN
    ===================================================== */

    .form-card {
        background: white;
        border: 1px solid #e5eaf1;
        border-radius: 16px;
        padding: 25px;

        box-shadow:
            0 5px 18px rgba(15,23,42,.04);
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-label {
        display: block;
        margin-bottom: 7px;
        color: #334155;
        font-size: 13px;
        font-weight: 600;
    }

    .form-required {
        color: #dc2626;
    }

    .form-control {
        width: 100%;
        padding: 11px 13px;

        border: 1px solid #cbd5e1;
        border-radius: 9px;

        background: white;
        color: #334155;

        font-family: inherit;
        font-size: 13px;

        outline: none;

        transition: border-color .2s ease,
                    box-shadow .2s ease;
    }

    .form-control:focus {
        border-color: #2563eb;

        box-shadow:
            0 0 0 3px rgba(37,99,235,.10);
    }

    textarea.form-control {
        min-height: 130px;
        resize: vertical;
    }

    .form-help {
        display: block;
        margin-top: 6px;
        color: #64748b;
        font-size: 11px;
    }

    .form-error {
        margin-top: 6px;
        color: #dc2626;
        font-size: 12px;
    }


    /* =====================================================
       ERROR VALIDASI
    ===================================================== */

    .validation-error {
        padding: 14px 17px;
        margin-bottom: 20px;

        background: #fef2f2;
        color: #991b1b;

        border: 1px solid #fecaca;
        border-radius: 11px;

        font-size: 13px;
    }

    .validation-error strong {
        display: block;
        margin-bottom: 7px;
    }

    .validation-error ul {
        margin: 0;
        padding-left: 20px;
    }

    .validation-error li {
        margin-bottom: 4px;
    }


    /* =====================================================
       TOMBOL
    ===================================================== */

    .form-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 10px;

        padding-top: 8px;
        margin-top: 8px;

        border-top: 1px solid #e2e8f0;
    }

    .btn-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        padding: 10px 16px;

        border-radius: 9px;

        background: #f1f5f9;
        color: #475569;

        font-size: 13px;
        font-weight: 600;

        text-decoration: none;

        transition: .2s ease;
    }

    .btn-secondary:hover {
        background: #e2e8f0;
        color: #334155;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 700px) {

        .data-grid {
            grid-template-columns: 1fr;
        }

        .data-item.full {
            grid-column: auto;
        }

        .pengajuan-card,
        .form-card {
            padding: 18px;
        }

        .page-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .form-actions {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .form-actions .btn,
        .form-actions .btn-secondary {
            width: 100%;
        }
    }
</style>

@endsection


@section('content')

<div class="penanganan-wrapper">

    {{-- =====================================================
         HEADER HALAMAN
    ====================================================== --}}

    <div class="page-header">

        <h3>
            Penanganan Pengajuan
        </h3>

        <a
            href="{{ route('admin.pengajuan.show', $pengajuan->id_pengajuan) }}"
            class="back-link"
        >
            ← Kembali ke Detail Pengajuan
        </a>

    </div>


    {{-- =====================================================
         ERROR VALIDASI
    ====================================================== --}}

    @if ($errors->any())

        <div class="validation-error">

            <strong>
                ⚠ Terjadi kesalahan:
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


    {{-- =====================================================
         DATA PENGAJUAN
    ====================================================== --}}

    <div class="pengajuan-card">

        <h4 class="section-title">
            Data Pengajuan
        </h4>


        <div class="data-grid">


            {{-- MASYARAKAT --}}

            <div class="data-item">

                <span class="data-label">
                    Masyarakat
                </span>

                <div class="data-value">

                    {{ $pengajuan->masyarakat->nama ?? '-' }}

                </div>

            </div>


            {{-- KATEGORI --}}

            <div class="data-item">

                <span class="data-label">
                    Kategori
                </span>

                <div class="data-value">

                    {{ $pengajuan->kategori->nama_kategori ?? '-' }}

                </div>

            </div>


            {{-- JUDUL --}}

            <div class="data-item full">

                <span class="data-label">
                    Judul Pengajuan
                </span>

                <div class="data-value">

                    {{ $pengajuan->judul }}

                </div>

            </div>


            {{-- KETERANGAN --}}

            <div class="data-item full">

                <span class="data-label">
                    Keterangan Pengajuan
                </span>

                <div class="data-value">

                    {{ $pengajuan->keterangan }}

                </div>

            </div>


            {{-- LOKASI --}}

            <div class="data-item full">

                <span class="data-label">
                    Lokasi Pengaduan
                </span>

                <div class="data-value">

                    {{ $pengajuan->lokasi }}

                    @if ($pengajuan->latitude && $pengajuan->longitude)

                        <br>

                        <small style="color:#64748b;">

                            Latitude:
                            {{ $pengajuan->latitude }}

                            &nbsp; | &nbsp;

                            Longitude:
                            {{ $pengajuan->longitude }}

                        </small>

                    @endif

                </div>

            </div>


            {{-- STATUS --}}

            <div class="data-item">

                <span class="data-label">
                    Status Saat Ini
                </span>

                <div class="data-value">

                    {{ ucfirst($pengajuan->status) }}

                </div>

            </div>


            {{-- TANGGAL --}}

            <div class="data-item">

                <span class="data-label">
                    Tanggal Pengajuan
                </span>

                <div class="data-value">

                    {{ $pengajuan->tanggal
                        ? \Carbon\Carbon::parse($pengajuan->tanggal)->format('d-m-Y')
                        : '-'
                    }}

                </div>

            </div>

        </div>


        {{-- =================================================
             GAMBAR PENGAJUAN
        ================================================== --}}

        @if ($pengajuan->gambar)

            <div class="gambar-pengajuan">

                <span class="gambar-pengajuan-label">
                    Gambar Pengajuan
                </span>

                <img
                    src="{{ asset('storage/' . $pengajuan->gambar) }}"
                    alt="Gambar Pengajuan"
                >

            </div>

        @endif

    </div>


    {{-- =====================================================
         FORM PENANGANAN
    ====================================================== --}}

    <div class="form-card">

        <h4 class="section-title">
            Form Penanganan
        </h4>


        <form
            action="{{ route('admin.penanganan.store', $pengajuan->id_pengajuan) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            {{-- STATUS PENANGANAN --}}

            <div class="form-group">

                <label
                    for="status"
                    class="form-label"
                >
                    Status Penanganan
                    <span class="form-required">*</span>
                </label>

                <select
                    name="status"
                    id="status"
                    class="form-control"
                    required
                >

                    <option value="">
                        -- Pilih Status --
                    </option>

                    <option
                        value="diproses"
                        {{ old('status') === 'diproses' ? 'selected' : '' }}
                    >
                        Diproses
                    </option>

                    <option
                        value="ditangani"
                        {{ old('status') === 'ditangani' ? 'selected' : '' }}
                    >
                        Ditangani
                    </option>

                    <option
                        value="selesai"
                        {{ old('status') === 'selesai' ? 'selected' : '' }}
                    >
                        Selesai
                    </option>

                    <option
                        value="ditolak"
                        {{ old('status') === 'ditolak' ? 'selected' : '' }}
                    >
                        Ditolak
                    </option>

                </select>

                @error('status')

                    <div class="form-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- TANGGAL PENANGANAN --}}

            <div class="form-group">

                <label
                    for="tanggal_penanganan"
                    class="form-label"
                >
                    Tanggal Penanganan
                    <span class="form-required">*</span>
                </label>

                <input
                    type="date"
                    name="tanggal_penanganan"
                    id="tanggal_penanganan"
                    class="form-control"
                    value="{{ old('tanggal_penanganan', date('Y-m-d')) }}"
                    required
                >

                @error('tanggal_penanganan')

                    <div class="form-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- KETERANGAN PENANGANAN --}}

            <div class="form-group">

                <label
                    for="keterangan"
                    class="form-label"
                >
                    Keterangan Penanganan
                </label>

                <textarea
                    name="keterangan"
                    id="keterangan"
                    class="form-control"
                    rows="6"
                    placeholder="Tuliskan tindakan atau hasil penanganan..."
                >{{ old('keterangan') }}</textarea>

                <small class="form-help">
                    Jelaskan tindakan yang dilakukan atau hasil penanganan pengaduan.
                </small>

                @error('keterangan')

                    <div class="form-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- FOTO PENANGANAN --}}

            <div class="form-group">

                <label
                    for="gambar"
                    class="form-label"
                >
                    Foto Penanganan
                </label>

                <input
                    type="file"
                    name="gambar"
                    id="gambar"
                    class="form-control"
                    accept="image/jpeg,image/png,image/webp"
                >

                <small class="form-help">
                    Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                </small>

                @error('gambar')

                    <div class="form-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- =================================================
                 BUTTON
            ================================================== --}}

            <div class="form-actions">

                <a
                    href="{{ route('admin.pengajuan.show', $pengajuan->id_pengajuan) }}"
                    class="btn-secondary"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    ✓ Simpan Penanganan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection