@extends('layouts.admin')

@section('title', 'Laporan Pengajuan')

@section('styles')

<style>

    /* =====================================================
       PAGINATION
    ===================================================== */

    .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;

        margin-top: 18px;
        padding-top: 16px;

        border-top: 1px solid #e5e7eb;

        gap: 20px;
    }


    .pagination-info {
        color: #64748b;
        font-size: 13px;
        white-space: nowrap;
    }


    .pagination-info strong {
        color: #334155;
        font-weight: 600;
    }


    .pagination-links {
        display: flex;
        align-items: center;
        gap: 4px;
    }


    /* =====================================================
       TOMBOL PAGINATION
    ===================================================== */

    .pagination-button,
    .pagination-active,
    .pagination-disabled {

        width: 34px;
        height: 34px;

        display: inline-flex;

        align-items: center;
        justify-content: center;

        border-radius: 7px;

        font-size: 13px;

        text-decoration: none;

        box-sizing: border-box;
    }


    /* Tombol biasa */

    .pagination-button {

        background: #ffffff;

        border: 1px solid #e2e8f0;

        color: #475569;

        transition: all .2s ease;
    }


    .pagination-button:hover {

        background: #eff6ff;

        border-color: #2563eb;

        color: #2563eb;
    }


    /* Halaman aktif */

    .pagination-active {

        background: #2563eb;

        border: 1px solid #2563eb;

        color: #ffffff;

        font-weight: 600;
    }


    /* Tombol disabled */

    .pagination-disabled {

        background: #f8fafc;

        border: 1px solid #e2e8f0;

        color: #cbd5e1;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 750px) {

        .pagination-wrapper {

            flex-direction: column;

            align-items: flex-start;

            gap: 12px;
        }


        .pagination-info {

            white-space: normal;
        }

    }

</style>

@endsection


@section('content')


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div style="
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    ">

        <div>

            <p style="
                color: #6b7280;
                margin: 0;
            ">
                Rekapitulasi seluruh pengajuan masyarakat.
            </p>

        </div>


        <div>

            <a
                href="{{ route('admin.laporan.cetak') }}"
                target="_blank"
                class="btn btn-primary"
            >
                Cetak Laporan
            </a>

        </div>

    </div>



    {{-- =====================================================
         CARD LAPORAN
    ====================================================== --}}

    <div class="card">


        {{-- =================================================
             TABEL LAPORAN
        ================================================== --}}

        <div style="overflow-x: auto;">

            <table>

                <thead>

                    <tr>

                        <th>
                            No
                        </th>

                        <th>
                            Masyarakat
                        </th>

                        <th>
                            Kategori
                        </th>

                        <th>
                            Judul
                        </th>

                        <th>
                            Lokasi
                        </th>

                        <th>
                            Tanggal
                        </th>

                        <th>
                            Status
                        </th>

                    </tr>

                </thead>


                <tbody>


                    @forelse ($pengajuans as $pengajuan)


                        <tr>


                            {{-- =================================================
                                 NOMOR DATA
                                 Nomor tetap berlanjut antar halaman
                            ================================================== --}}

                            <td>

                                {{ $pengajuans->firstItem() + $loop->index }}

                            </td>


                            {{-- =================================================
                                 MASYARAKAT
                            ================================================== --}}

                            <td>

                                {{ $pengajuan->masyarakat->nama ?? '-' }}

                            </td>


                            {{-- =================================================
                                 KATEGORI
                            ================================================== --}}

                            <td>

                                {{ $pengajuan->kategori->nama_kategori ?? '-' }}

                            </td>


                            {{-- =================================================
                                 JUDUL
                            ================================================== --}}

                            <td>

                                {{ $pengajuan->judul }}

                            </td>


                            {{-- =================================================
                                 LOKASI
                            ================================================== --}}

                            <td>

                                {{ $pengajuan->lokasi }}

                            </td>


                            {{-- =================================================
                                 TANGGAL
                            ================================================== --}}

                            <td>

                                {{ $pengajuan->tanggal
                                    ? $pengajuan->tanggal->format('d-m-Y')
                                    : '-'
                                }}

                            </td>


                            {{-- =================================================
                                 STATUS
                            ================================================== --}}

                            <td>


                                @if ($pengajuan->status === 'diajukan')


                                    <span style="
                                        background:#fef3c7;
                                        color:#92400e;
                                        padding:5px 10px;
                                        border-radius:6px;
                                    ">
                                        Diajukan
                                    </span>


                                @elseif ($pengajuan->status === 'diproses')


                                    <span style="
                                        background:#dbeafe;
                                        color:#1e40af;
                                        padding:5px 10px;
                                        border-radius:6px;
                                    ">
                                        Diproses
                                    </span>


                                @elseif ($pengajuan->status === 'selesai')


                                    <span style="
                                        background:#dcfce7;
                                        color:#166534;
                                        padding:5px 10px;
                                        border-radius:6px;
                                    ">
                                        Selesai
                                    </span>


                                @elseif ($pengajuan->status === 'ditolak')


                                    <span style="
                                        background:#fee2e2;
                                        color:#991b1b;
                                        padding:5px 10px;
                                        border-radius:6px;
                                    ">
                                        Ditolak
                                    </span>


                                @else


                                    <span style="
                                        background:#f1f5f9;
                                        color:#475569;
                                        padding:5px 10px;
                                        border-radius:6px;
                                    ">
                                        {{ ucfirst($pengajuan->status) }}
                                    </span>


                                @endif


                            </td>


                        </tr>


                    @empty


                        <tr>

                            <td
                                colspan="7"
                                style="
                                    text-align:center;
                                    padding:30px;
                                "
                            >
                                Belum ada data pengajuan.
                            </td>

                        </tr>


                    @endforelse


                </tbody>

            </table>

        </div>



        {{-- =====================================================
             PAGINATION
        ====================================================== --}}

        @if ($pengajuans->hasPages())


            <div class="pagination-wrapper">


                {{-- =================================================
                     INFORMASI DATA
                ================================================== --}}

                <div class="pagination-info">

                    Menampilkan

                    <strong>
                        {{ $pengajuans->firstItem() }}
                    </strong>

                    -

                    <strong>
                        {{ $pengajuans->lastItem() }}
                    </strong>

                    dari

                    <strong>
                        {{ $pengajuans->total() }}
                    </strong>

                    pengaduan

                </div>



                {{-- =================================================
                     PAGINATION
                ================================================== --}}

                <div class="pagination-links">


                    {{-- PREVIOUS --}}

                    @if ($pengajuans->onFirstPage())


                        <span class="pagination-disabled">
                            ‹
                        </span>


                    @else


                        <a
                            href="{{ $pengajuans->previousPageUrl() }}"
                            class="pagination-button"
                        >
                            ‹
                        </a>


                    @endif



                    {{-- NOMOR HALAMAN --}}

                    @for (
                        $page = 1;
                        $page <= $pengajuans->lastPage();
                        $page++
                    )


                        @if ($page == $pengajuans->currentPage())


                            <span class="pagination-active">

                                {{ $page }}

                            </span>


                        @else


                            <a
                                href="{{ $pengajuans->url($page) }}"
                                class="pagination-button"
                            >

                                {{ $page }}

                            </a>


                        @endif


                    @endfor



                    {{-- NEXT --}}

                    @if ($pengajuans->hasMorePages())


                        <a
                            href="{{ $pengajuans->nextPageUrl() }}"
                            class="pagination-button"
                        >

                            ›

                        </a>


                    @else


                        <span class="pagination-disabled">

                            ›

                        </span>


                    @endif


                </div>


            </div>


        @endif


    </div>


@endsection