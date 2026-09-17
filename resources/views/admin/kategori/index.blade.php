@extends('layouts.admin')

@section('title', 'Kategori')

@section('content')

<style>

    /* =====================================================
       KHUSUS HALAMAN KATEGORI
    ===================================================== */

    .kategori-page {
        width: 100%;
    }


    /* =====================================================
       HEADER
    ===================================================== */

    .kategori-header {
        display: flex;
        justify-content: space-between;
        align-items: center;

        margin-bottom: 18px;

        gap: 20px;
    }


    .kategori-header p {
        margin: 0;

        color: #64748b;

        font-size: 15px;
    }


    /* =====================================================
       TABEL KATEGORI
    ===================================================== */

    .kategori-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }


    .kategori-page table {
        width: 100%;
        border-collapse: collapse;
    }


    .kategori-page table th {

        padding: 10px 12px;

        font-size: 12.5px;

        font-weight: 700;

        color: #526581;

        white-space: nowrap;

        text-align: left;
    }


    .kategori-page table td {

        padding: 10px 12px !important;

        font-size: 13px;

        line-height: 1.3 !important;

        color: #243b5a;

        vertical-align: middle;
    }

    /* Memadatkan jarak antarbaris khusus halaman kategori */

    .kategori-page table tbody tr {
        height: auto !important;
    }

    .kategori-page table tbody td {
        height: auto !important;
        min-height: 0 !important;
    }

    .kategori-page table tbody tr td {
        padding-top: 10px !important;
        padding-bottom: 10px !important;
    }


    /* Nomor */

    .kategori-page table th:first-child,
    .kategori-page table td:first-child {

        width: 55px;

        text-align: left;
    }


    /* Nama kategori */

    .kategori-page table th:nth-child(2),
    .kategori-page table td:nth-child(2) {

        min-width: 180px;
    }


    /* Keterangan */

    .kategori-page table th:nth-child(3),
    .kategori-page table td:nth-child(3) {

        min-width: 300px;
    }


    /* Dibuat */

    .kategori-page table th:nth-child(4),
    .kategori-page table td:nth-child(4) {

        width: 120px;
    }


    /* Aksi */

    .kategori-page table th:nth-child(5),
    .kategori-page table td:nth-child(5) {

        width: 105px;
    }


    /* =====================================================
       TOMBOL AKSI
    ===================================================== */

    .aksi-btn {

        width: 35px;
        height: 35px;

        border-radius: 9px;

        display: inline-flex;

        align-items: center;
        justify-content: center;

        padding: 0;

        margin-right: 4px;

        box-sizing: border-box;

        cursor: pointer;

        background: #ffffff;

        text-decoration: none;

        transition: all 0.2s ease;
    }


    .aksi-btn svg {

        width: 17px;
        height: 17px;

        display: block;
    }


    /* =====================================================
       EDIT
    ===================================================== */

    .aksi-edit {

        color: #2563eb;

        border: 1.5px solid #93c5fd;
    }


    .aksi-edit:hover {

        color: #1d4ed8;

        background: #eff6ff;

        border-color: #2563eb;

        transform: translateY(-1px);
    }


    /* =====================================================
       HAPUS
    ===================================================== */

    .aksi-hapus {

        color: #ef4444;

        border: 1.5px solid #fca5a5;
    }


    .aksi-hapus:hover {

        color: #dc2626;

        background: #fef2f2;

        border-color: #ef4444;

        transform: translateY(-1px);
    }


    .aksi-form {

        display: inline;

        margin: 0;

        padding: 0;
    }


    /* =====================================================
       CARD
    ===================================================== */

    .kategori-card {

        overflow: hidden;
    }


    /* =====================================================
       PESAN SUCCESS / ERROR
    ===================================================== */

    .kategori-message {

        margin-bottom: 18px;

        padding: 14px 18px;

        font-size: 14px;
    }


    /* =====================================================
       MODAL EDIT KATEGORI
    ===================================================== */

    .modal-overlay {

        position: fixed;

        inset: 0;

        background: rgba(15, 23, 42, 0.45);

        display: none;

        align-items: center;

        justify-content: center;

        z-index: 2000;

        padding: 20px;
    }


    .modal-overlay.active {

        display: flex;
    }


    .modal-box {

        width: 100%;

        max-width: 500px;

        background: #ffffff;

        border-radius: 14px;

        box-shadow:
            0 20px 50px rgba(15, 23, 42, 0.20);

        overflow: hidden;

        animation: modalMasuk .2s ease;
    }


    @keyframes modalMasuk {

        from {

            opacity: 0;

            transform: translateY(-15px) scale(.98);

        }

        to {

            opacity: 1;

            transform: translateY(0) scale(1);

        }
    }


    .modal-header {

        display: flex;

        align-items: center;

        justify-content: space-between;

        padding: 17px 20px;

        border-bottom: 1px solid #e5e7eb;
    }


    .modal-header h2 {

        margin: 0;

        color: #1e3a8a;

        font-size: 19px;

        font-weight: 800;
    }


    .modal-close {

        width: 34px;
        height: 34px;

        border: none;

        border-radius: 8px;

        background: #f1f5f9;

        color: #64748b;

        font-size: 21px;

        cursor: pointer;

        display: flex;

        align-items: center;

        justify-content: center;
    }


    .modal-close:hover {

        background: #e2e8f0;

        color: #0f172a;
    }


    .modal-body {

        padding: 20px;
    }


    .modal-field {

        margin-bottom: 17px;
    }


    .modal-field:last-child {

        margin-bottom: 0;
    }


    .modal-field label {

        display: block;

        margin-bottom: 6px;

        color: #334155;

        font-size: 13px;

        font-weight: 700;
    }


    .modal-field input,
    .modal-field textarea {

        width: 100%;

        padding: 10px 11px;

        border: 1px solid #d1d5db;

        border-radius: 8px;

        font-family: inherit;

        font-size: 14px;

        color: #334155;

        outline: none;

        box-sizing: border-box;
    }


    .modal-field input:focus,
    .modal-field textarea:focus {

        border-color: #2563eb;

        box-shadow:
            0 0 0 3px rgba(37, 99, 235, .10);
    }


    .modal-field textarea {

        min-height: 100px;

        resize: vertical;
    }


    .modal-footer {

        display: flex;

        justify-content: flex-end;

        gap: 8px;

        padding: 15px 20px;

        border-top: 1px solid #e5e7eb;

        background: #f8fafc;
    }


    .modal-btn {

        padding: 9px 14px;

        border: none;

        border-radius: 8px;

        font-family: inherit;

        font-size: 13px;

        font-weight: 600;

        cursor: pointer;
    }


    .modal-btn-batal {

        background: #e2e8f0;

        color: #334155;
    }


    .modal-btn-batal:hover {

        background: #cbd5e1;
    }


    .modal-btn-update {

        background: #2563eb;

        color: white;
    }


    .modal-btn-update:hover {

        background: #1d4ed8;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 800px) {

        .kategori-header {

            align-items: flex-start;

            flex-direction: column;
        }


        .kategori-header .btn {

            width: 100%;

            text-align: center;
        }


        .kategori-page table th,
        .kategori-page table td {

            padding: 12px 10px;

            font-size: 13px;
        }

    }


    @media (max-width: 600px) {

        .modal-box {

            max-width: 100%;
        }


        .modal-header {

            padding: 16px 18px;
        }


        .modal-body {

            padding: 18px;
        }


        .modal-footer {

            padding: 14px 18px;
        }

    }

</style>


<div class="kategori-page">


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="kategori-header">

        <div>

            <p>
                Kelola kategori pengaduan masyarakat.
            </p>

        </div>


        <a
            href="{{ route('admin.kategori.create') }}"
            class="btn btn-primary"
        >
            + Tambah Kategori
        </a>

    </div>



    {{-- =====================================================
         PESAN SUCCESS
    ====================================================== --}}

    @if (session('success'))

        <div
            class="card kategori-message"
            style="
                border-left: 4px solid #16a34a;
            "
        >

            <strong style="color:#166534;">
                {{ session('success') }}
            </strong>

        </div>

    @endif



    {{-- =====================================================
         PESAN ERROR
    ====================================================== --}}

    @if (session('error'))

        <div
            class="card kategori-message"
            style="
                border-left: 4px solid #dc2626;
            "
        >

            <strong style="color:#991b1b;">
                {{ session('error') }}
            </strong>

        </div>

    @endif



    {{-- =====================================================
         TABEL KATEGORI
    ====================================================== --}}

    <div class="card kategori-card">

        <div class="kategori-table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>
                            No
                        </th>

                        <th>
                            Nama Kategori
                        </th>

                        <th>
                            Keterangan
                        </th>

                        <th>
                            Dibuat
                        </th>

                        <th>
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>


                    @forelse ($kategoris as $kategori)


                        <tr>


                            {{-- NOMOR --}}

                            <td>

                                {{ $loop->iteration }}

                            </td>



                            {{-- NAMA KATEGORI --}}

                            <td>

                                {{ $kategori->nama_kategori }}

                            </td>



                            {{-- KETERANGAN --}}

                            <td>

                                {{ $kategori->keterangan ?? '-' }}

                            </td>



                            {{-- TANGGAL DIBUAT --}}

                            <td>

                                {{ $kategori->created_at->format('d-m-Y') }}

                            </td>



                            {{-- AKSI --}}

                            <td>


                                {{-- EDIT --}}

                                <button
                                    type="button"
                                    class="aksi-btn aksi-edit"
                                    title="Edit"
                                    aria-label="Edit"

                                    onclick="bukaModalEdit(
                                        {{ $kategori->id_kategori }},
                                        @js($kategori->nama_kategori),
                                        @js($kategori->keterangan)
                                    )"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2.2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >

                                        <path d="M12 20h9"/>

                                        <path d="
                                            M16.5 3.5
                                            a2.1 2.1 0 0 1 3 3
                                            L7 19
                                            l-4 1
                                            1-4
                                            Z
                                        "/>

                                    </svg>

                                </button>



                                {{-- HAPUS --}}

                                <form
                                    action="{{ route('admin.kategori.destroy', $kategori->id_kategori) }}"
                                    method="POST"
                                    class="aksi-form"

                                    onsubmit="
                                        return confirm(
                                            'Yakin ingin menghapus kategori ini?'
                                        )
                                    "
                                >

                                    @csrf

                                    @method('DELETE')


                                    <button
                                        type="submit"
                                        class="aksi-btn aksi-hapus"
                                        title="Hapus"
                                        aria-label="Hapus"
                                    >

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2.2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >

                                            <path d="M3 6h18"/>

                                            <path d="M8 6V4h8v2"/>

                                            <path d="
                                                M19 6
                                                l-1 14
                                                H6
                                                L5 6
                                            "/>

                                            <path d="M10 11v5"/>

                                            <path d="M14 11v5"/>

                                        </svg>

                                    </button>

                                </form>


                            </td>


                        </tr>


                    @empty


                        <tr>

                            <td
                                colspan="5"
                                style="
                                    text-align:center;
                                    padding:30px;
                                "
                            >

                                Belum ada kategori.

                            </td>

                        </tr>


                    @endforelse


                </tbody>

            </table>

        </div>

    </div>



    {{-- =====================================================
         MODAL EDIT KATEGORI
    ====================================================== --}}

    <div
        id="modalEditKategori"
        class="modal-overlay"
        onclick="tutupModalJikaKlikLuar(event)"
    >

        <div
            class="modal-box"
            onclick="event.stopPropagation()"
        >


            {{-- HEADER MODAL --}}

            <div class="modal-header">

                <h2>
                    Edit Kategori
                </h2>


                <button
                    type="button"
                    class="modal-close"
                    onclick="tutupModalEdit()"
                >
                    ×
                </button>

            </div>



            {{-- FORM EDIT --}}

            <form
                id="formEditKategori"
                method="POST"
            >

                @csrf

                @method('PUT')


                <div class="modal-body">


                    {{-- NAMA KATEGORI --}}

                    <div class="modal-field">

                        <label for="edit_nama_kategori">
                            Nama Kategori
                        </label>

                        <input
                            type="text"
                            id="edit_nama_kategori"
                            name="nama_kategori"
                            required
                        >

                        @error('nama_kategori')

                            <p style="
                                color:#dc2626;
                                margin-top:5px;
                                font-size:13px;
                            ">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>



                    {{-- KETERANGAN --}}

                    <div class="modal-field">

                        <label for="edit_keterangan">
                            Keterangan
                        </label>

                        <textarea
                            id="edit_keterangan"
                            name="keterangan"
                            placeholder="Masukkan keterangan kategori..."
                        ></textarea>

                        @error('keterangan')

                            <p style="
                                color:#dc2626;
                                margin-top:5px;
                                font-size:13px;
                            ">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                </div>



                {{-- FOOTER MODAL --}}

                <div class="modal-footer">

                    <button
                        type="button"
                        class="modal-btn modal-btn-batal"
                        onclick="tutupModalEdit()"
                    >
                        Batal
                    </button>


                    <button
                        type="submit"
                        class="modal-btn modal-btn-update"
                    >
                        Update Kategori
                    </button>

                </div>


            </form>


        </div>

    </div>



</div>


{{-- =====================================================
     SCRIPT MODAL
===================================================== --}}

<script>

    function bukaModalEdit(
        id,
        nama,
        keterangan
    ) {

        const modal =
            document.getElementById(
                'modalEditKategori'
            );

        const form =
            document.getElementById(
                'formEditKategori'
            );

        const namaInput =
            document.getElementById(
                'edit_nama_kategori'
            );

        const keteranganInput =
            document.getElementById(
                'edit_keterangan'
            );


        /*
         * Masukkan data kategori
         */

        namaInput.value =
            nama ?? '';

        keteranganInput.value =
            keterangan ?? '';


        /*
         * URL update kategori
         */

        form.action =
            "{{ url('/admin/kategori') }}/" + id;


        /*
         * Tampilkan modal
         */

        modal.classList.add(
            'active'
        );


        /*
         * Fokus ke input nama
         */

        setTimeout(
            function () {

                namaInput.focus();

            },
            100
        );

    }


    function tutupModalEdit() {

        const modal =
            document.getElementById(
                'modalEditKategori'
            );

        modal.classList.remove(
            'active'
        );

    }


    function tutupModalJikaKlikLuar(event) {

        if (
            event.target.id ===
            'modalEditKategori'
        ) {

            tutupModalEdit();

        }

    }


    /*
     * Tutup dengan tombol ESC
     */

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape'
            ) {

                tutupModalEdit();

            }

        }
    );

</script>

@endsection