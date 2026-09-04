@extends('layouts.masyarakat')

@section('title', 'Pengajuan Saya')


@section('styles')

<style>

/* =====================================================
   HEADER PENGAJUAN
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

    transform:
        translateY(-2px);

    filter:
        brightness(.95);
}


/* IKON */

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
   MOBILE
===================================================== */

@media (max-width: 700px) {

    .page-header {

        flex-direction: column;

        align-items: flex-start;

        gap: 12px;
    }

    .page-title {

        font-size: 24px;
    }

    .page-description {

        font-size: 12px;
    }

    .page-header .btn {

        align-self: flex-start;
    }

    .aksi-column {

        width: 110px;
    }

    .aksi-buttons {

        gap: 4px;
    }

    .aksi-btn {

        width: 30px;

        height: 30px;
    }

    .aksi-btn svg {

        width: 16px;

        height: 16px;
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

                        <th>
                            No
                        </th>

                        <th>
                            Judul
                        </th>

                        <th>
                            Kategori
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
                                {{ $loop->iteration }}
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
                                {{ $pengajuan->tanggal->format('d-m-Y') }}
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

                                @elseif ($pengajuan->status === 'ditangani')

                                    <span class="badge badge-info">
                                        Ditangani
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
                                        href="{{ route('masyarakat.pengajuan.show', $pengajuan->id_pengajuan) }}"
                                        class="aksi-btn aksi-lihat"
                                        title="Lihat pengajuan"
                                        aria-label="Lihat pengajuan"
                                    >

                                        <svg
                                            viewBox="0 0 24 24"
                                        >

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


                                        {{-- EDIT --}}

                                        <a
                                            href="{{ route('masyarakat.pengajuan.edit', $pengajuan->id_pengajuan) }}"
                                            class="aksi-btn aksi-edit"
                                            title="Edit pengajuan"
                                            aria-label="Edit pengajuan"
                                        >

                                            <svg
                                                viewBox="0 0 24 24"
                                            >

                                                <path
                                                    d="M12 20h9"
                                                />

                                                <path
                                                    d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"
                                                />

                                            </svg>

                                        </a>


                                        {{-- HAPUS --}}

                                        <form
                                            action="{{ route('masyarakat.pengajuan.destroy', $pengajuan->id_pengajuan) }}"
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

                                                <svg
                                                    viewBox="0 0 24 24"
                                                >

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


    @else


        {{-- =================================================
             EMPTY
        ================================================== --}}

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


@endsection