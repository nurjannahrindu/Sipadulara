@extends('layouts.admin')

@section('title', 'Penanganan Pengajuan')

@section('styles')

<style>

    /* =====================================================
       DATA PENGAJUAN
    ===================================================== */

    .data-card {

        background: #ffffff;

        border: 1px solid #e5eaf1;

        border-radius: 16px;

        padding: 26px;

        margin-bottom: 20px;

        box-shadow:
            0 5px 18px rgba(15,23,42,.04);
    }


    .section-title {

        margin: 0 0 22px;

        color: #1e3a8a;

        font-size: 20px;

        font-weight: 800;
    }


    .data-grid {

        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 18px;
    }


    .data-item {

        padding: 15px;

        background: #f8fafc;

        border: 1px solid #e2e8f0;

        border-radius: 11px;
    }


    .data-item.full {

        grid-column: 1 / -1;
    }


    .data-label {

        display: block;

        margin-bottom: 7px;

        color: #64748b;

        font-size: 12px;

        font-weight: 700;
    }


    .data-value {

        color: #334155;

        font-size: 14px;

        line-height: 1.6;
    }


    /* =====================================================
       GAMBAR PENGADUAN
    ===================================================== */

    .gambar-pengajuan {

        margin-top: 20px;

        padding-top: 20px;

        border-top: 1px solid #e2e8f0;
    }


    .gambar-pengajuan-label {

        display: block;

        margin-bottom: 10px;

        color: #334155;

        font-size: 13px;

        font-weight: 700;
    }


    .gambar-pengajuan img {

        display: block;

        width: 100%;

        max-width: 500px;

        max-height: 400px;

        object-fit: contain;

        border: 1px solid #e2e8f0;

        border-radius: 10px;

        padding: 5px;

        background: #f8fafc;
    }


    /* =====================================================
       FORM
    ===================================================== */

    .form-card {

        background: #ffffff;

        border: 1px solid #e5eaf1;

        border-radius: 16px;

        padding: 26px;

        box-shadow:
            0 5px 18px rgba(15,23,42,.04);
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


    .form-required {

        color: #dc2626;
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

        margin-top: 7px;

        color: #64748b;

        font-size: 11px;

        line-height: 1.5;
    }


    .form-error {

        margin-top: 7px;

        color: #dc2626;

        font-size: 12px;
    }


    /* =====================================================
       PREVIEW FOTO PENANGANAN
    ===================================================== */

    #previewContainer {

        display: none;

        margin-top: 12px;
    }


    .preview-title {

        margin-bottom: 8px;

        color: #64748b;

        font-size: 12px;

        font-weight: 600;
    }


    #previewImage {

        display: block;

        width: 100%;

        max-width: 400px;

        max-height: 300px;

        object-fit: contain;

        border: 1px solid #cbd5e1;

        border-radius: 10px;

        background: #f8fafc;

        padding: 5px;
    }


    /* =====================================================
       BUTTON
    ===================================================== */

    .form-actions {

        display: flex;

        justify-content: flex-end;

        align-items: center;

        gap: 10px;

        padding-top: 5px;
    }


    .btn-secondary {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        min-height: 40px;

        padding: 10px 16px;

        border-radius: 9px;

        background: #e2e8f0;

        color: #334155;

        font-size: 13px;

        font-weight: 600;

        text-decoration: none;
    }


    .btn-secondary:hover {

        background: #cbd5e1;
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


        .form-actions {

            flex-direction: column-reverse;

            align-items: stretch;
        }


        .btn-secondary {

            width: 100%;
        }

    }

</style>

@endsection


@section('content')

{{-- =====================================================
     HEADER
===================================================== --}}

<div
    style="
        margin-bottom: 20px;
    "
>

    <h1
        style="
            margin: 0;
            color: #0f172a;
            font-size: 28px;
            font-weight: 800;
        "
    >
        Penanganan Pengajuan
    </h1>

    <p
        style="
            margin: 7px 0 0;
            color: #64748b;
            font-size: 13px;
        "
    >
        Kelola dan tindak lanjuti pengajuan masyarakat.
    </p>

</div>


{{-- =====================================================
     DATA PENGAJUAN
===================================================== --}}

<div class="data-card">

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

                {{ $pengajuan->masyarakat->nama }}

            </div>

        </div>


        {{-- KATEGORI --}}

        <div class="data-item">

            <span class="data-label">
                Kategori
            </span>

            <div class="data-value">

                {{ $pengajuan->kategori->nama_kategori }}

            </div>

        </div>


        {{-- JUDUL --}}

        <div class="data-item full">

            <span class="data-label">
                Judul Pengaduan
            </span>

            <div class="data-value">

                {{ $pengajuan->judul }}

            </div>

        </div>


        {{-- KETERANGAN --}}

        <div class="data-item full">

            <span class="data-label">
                Keterangan Pengaduan
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

                    <small
                        style="
                            color:#64748b;
                        "
                    >

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
         GAMBAR PENGADUAN MASYARAKAT
    ================================================== --}}

    @if ($pengajuan->gambar)

        <div class="gambar-pengajuan">

            <span class="gambar-pengajuan-label">
                Gambar Pengaduan
            </span>

            <img
                src="{{ asset('storage/' . $pengajuan->gambar) }}"
                alt="Gambar Pengaduan"
            >

        </div>

    @endif

</div>


{{-- =====================================================
     FORM PENANGANAN
===================================================== --}}

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

                <span class="form-required">
                    *
                </span>

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


        {{-- TANGGAL --}}

        <div class="form-group">

            <label
                for="tanggal_penanganan"
                class="form-label"
            >

                Tanggal Penanganan

                <span class="form-required">
                    *
                </span>

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


        {{-- =================================================
             FOTO PENANGANAN
        ================================================== --}}

        <div class="form-group">

            <label
                for="gambar_penanganan"
                class="form-label"
            >
                Foto Penanganan
            </label>


            <input
                type="file"
                name="gambar"
                id="gambar_penanganan"
                class="form-control"
                accept="image/jpeg,image/png,image/webp"
            >


            <small class="form-help">
                Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
            </small>


            {{-- PREVIEW FOTO --}}

            <div
                id="previewContainer"
            >

                <div class="preview-title">
                    Preview Foto
                </div>


                <img
                    id="previewImage"
                    src=""
                    alt="Preview Foto Penanganan"
                >

            </div>


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

@endsection


{{-- =====================================================
     SCRIPT PREVIEW FOTO
===================================================== --}}

@section('scripts')

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const input =
            document.getElementById(
                'gambar_penanganan'
            );


        const previewContainer =
            document.getElementById(
                'previewContainer'
            );


        const previewImage =
            document.getElementById(
                'previewImage'
            );


        if (
            !input ||
            !previewContainer ||
            !previewImage
        ) {
            return;
        }


        input.addEventListener(
            'change',
            function () {

                const file =
                    this.files[0];


                if (!file) {

                    previewContainer.style.display =
                        'none';

                    previewImage.src =
                        '';

                    return;
                }


                if (
                    !file.type.startsWith(
                        'image/'
                    )
                ) {

                    previewContainer.style.display =
                        'none';

                    previewImage.src =
                        '';

                    return;
                }


                const reader =
                    new FileReader();


                reader.onload =
                    function (e) {

                        previewImage.src =
                            e.target.result;

                        previewContainer.style.display =
                            'block';

                    };


                reader.readAsDataURL(file);

            }
        );

    }
);

</script>

@endsection