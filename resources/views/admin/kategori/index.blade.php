@extends('layouts.admin')

@section('title', 'Kategori')

@section('content')

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">

        <div>
            <h1 style="margin: 0;">Kategori Pengaduan</h1>

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


    {{-- PESAN SUCCESS --}}

    @if (session('success'))

        <div
            class="card"
            style="margin-bottom: 20px; border-left: 5px solid #16a34a;"
        >
            <strong style="color: #166534;">
                {{ session('success') }}
            </strong>
        </div>

    @endif


    {{-- PESAN ERROR --}}

    @if (session('error'))

        <div
            class="card"
            style="margin-bottom: 20px; border-left: 5px solid #dc2626;"
        >
            <strong style="color: #991b1b;">
                {{ session('error') }}
            </strong>
        </div>

    @endif


    {{-- TABEL KATEGORI --}}

    <div class="card">

        <div style="overflow-x: auto;">

            <table>

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Keterangan</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($kategoris as $kategori)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $kategori->nama_kategori }}
                            </td>

                            {{-- INI YANG DIPERBAIKI --}}
                            <td>
                                {{ $kategori->keterangan ?? '-' }}
                            </td>

                            <td>
                                {{ $kategori->created_at->format('d-m-Y') }}
                            </td>

                            <td>

                                <a
                                    href="{{ route('admin.kategori.edit', $kategori->id_kategori) }}"
                                    class="btn"
                                    style="background:#f59e0b;color:white;"
                                >
                                    Edit
                                </a>


                                <form
                                    action="{{ route('admin.kategori.destroy', $kategori->id_kategori) }}"
                                    method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger"
                                    >
                                        Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                style="text-align:center;padding:30px;"
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