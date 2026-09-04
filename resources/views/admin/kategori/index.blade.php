@extends('layouts.admin')

@section('title', 'Kategori')

@section('content')

<style>
    /* ================================
       TOMBOL AKSI KATEGORI
       ================================ */

    .aksi-btn {
        width: 48px;
        height: 48px;
        border-radius: 10px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        padding: 0;
        margin-right: 6px;

        box-sizing: border-box;
        cursor: pointer;

        background: #ffffff;

        text-decoration: none;

        transition: all 0.2s ease;
    }

    /* Ukuran ikon */
    .aksi-btn svg {
        width: 21px;
        height: 21px;
        display: block;
    }

    /* ================================
       EDIT - BIRU
       ================================ */

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

    /* ================================
       HAPUS - MERAH
       ================================ */

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

    /* ================================
       FORM HAPUS
       ================================ */

    .aksi-form {
        display: inline;
        margin: 0;
        padding: 0;
    }
</style>


{{-- ================================
     HEADER
     ================================ --}}

<div style="
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
">

    <div>
        <p style="color: #6b7280;">
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


{{-- ================================
     PESAN SUCCESS
     ================================ --}}

@if (session('success'))

    <div
        class="card"
        style="
            margin-bottom: 20px;
            border-left: 5px solid #16a34a;
        "
    >
        <strong style="color: #166534;">
            {{ session('success') }}
        </strong>
    </div>

@endif


{{-- ================================
     PESAN ERROR
     ================================ --}}

@if (session('error'))

    <div
        class="card"
        style="
            margin-bottom: 20px;
            border-left: 5px solid #dc2626;
        "
    >
        <strong style="color: #991b1b;">
            {{ session('error') }}
        </strong>
    </div>

@endif


{{-- ================================
     TABEL KATEGORI
     ================================ --}}

<div class="card">

    <div style="overflow-x: auto;">

        <table>

            <thead>

                <tr>

                    <th>No</th>

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


                        {{-- ================================
                             AKSI
                             ================================ --}}

                        <td>

                            {{-- EDIT --}}

                            <a
                                href="{{ route('admin.kategori.edit', $kategori->id_kategori) }}"
                                class="aksi-btn aksi-edit"
                                title="Edit"
                                aria-label="Edit"
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

                            </a>


                            {{-- HAPUS --}}

                            <form
                                action="{{ route('admin.kategori.destroy', $kategori->id_kategori) }}"
                                method="POST"
                                class="aksi-form"
                                onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
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
                                text-align: center;
                                padding: 30px;
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

@endsection 