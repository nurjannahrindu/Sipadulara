@extends('layouts.admin')

@section('title', 'Pengajuan Masyarakat')

@section('content')

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <div>
                <p style="color: #6b7280;">
                Daftar seluruh pengajuan dari masyarakat.
            </p>
        </div>
    </div>

    <div class="card">

        <div style="overflow-x: auto;">

            <table>

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Masyarakat</th>
                        <th>Kategori</th>
                        <th>Judul</th>
                        <th>Lokasi</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($pengajuans as $pengajuan)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $pengajuan->masyarakat->nama }}
                            </td>

                            <td>
                                {{ $pengajuan->kategori->nama_kategori }}
                            </td>

                            <td>
                                {{ $pengajuan->judul }}
                            </td>

                            <td>
                                {{ $pengajuan->lokasi }}
                            </td>

                            <td>
                                {{ $pengajuan->tanggal->format('d-m-Y') }}
                            </td>

                            <td>

                                @if ($pengajuan->status === 'diajukan')

                                    <span style="background: #fef3c7; color: #92400e; padding: 5px 10px; border-radius: 20px;">
                                        Diajukan
                                    </span>

                                @elseif ($pengajuan->status === 'diproses')

                                    <span style="background: #dbeafe; color: #1e40af; padding: 5px 10px; border-radius: 20px;">
                                        Diproses
                                    </span>

                                @elseif ($pengajuan->status === 'ditangani')

                                    <span style="background: #e0e7ff; color: #3730a3; padding: 5px 10px; border-radius: 20px;">
                                        Ditangani
                                    </span>

                                @elseif ($pengajuan->status === 'selesai')

                                    <span style="background: #dcfce7; color: #166534; padding: 5px 10px; border-radius: 20px;">
                                        Selesai
                                    </span>

                                @elseif ($pengajuan->status === 'ditolak')

                                    <span style="background: #fee2e2; color: #991b1b; padding: 5px 10px; border-radius: 20px;">
                                        Ditolak
                                    </span>

                                @endif

                            </td>

                            <td>

                                <a
                                    href="{{ route('admin.pengajuan.show', $pengajuan->id_pengajuan) }}"
                                    class="btn btn-primary"
                                >
                                    Lihat
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8" style="text-align: center; padding: 30px;">

                                Belum ada pengajuan.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

@endsection