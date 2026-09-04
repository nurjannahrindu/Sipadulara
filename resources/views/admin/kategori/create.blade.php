@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')

<div class="page-header">

    <div>
        <h1>Tambah Kategori</h1>

        <p style="color:#64748b; margin-top:5px;">
            Tambahkan kategori pengaduan baru.
        </p>
    </div>

</div>


<div class="card">

    <form
        action="{{ route('admin.kategori.store') }}"
        method="POST"
    >

        @csrf


        {{-- NAMA KATEGORI --}}

        <div style="margin-bottom:20px;">

            <label
                for="nama_kategori"
                style="display:block; margin-bottom:7px;"
            >
                <strong>Nama Kategori</strong>
            </label>

            <input
                type="text"
                id="nama_kategori"
                name="nama_kategori"
                value="{{ old('nama_kategori') }}"
                required
                placeholder="Contoh: Infrastruktur & Jalan"
                style="
                    width:100%;
                    padding:12px;
                    border:1px solid #d1d5db;
                    border-radius:8px;
                    font-size:14px;
                "
            >

            @error('nama_kategori')

                <p style="color:#dc2626; margin-top:5px;">
                    {{ $message }}
                </p>

            @enderror

        </div>


        {{-- KETERANGAN --}}

        <div style="margin-bottom:20px;">

            <label
                for="keterangan"
                style="display:block; margin-bottom:7px;"
            >
                <strong>Keterangan</strong>
            </label>

            <textarea
                id="keterangan"
                name="keterangan"
                rows="4"
                placeholder="Masukkan keterangan kategori..."
                style="
                    width:100%;
                    padding:12px;
                    border:1px solid #d1d5db;
                    border-radius:8px;
                    font-size:14px;
                    resize:vertical;
                "
            >{{ old('keterangan') }}</textarea>

            @error('keterangan')

                <p style="color:#dc2626; margin-top:5px;">
                    {{ $message }}
                </p>

            @enderror

        </div>


        {{-- TOMBOL --}}

        <div style="display:flex; gap:10px;">

            <a
                href="{{ route('admin.kategori.index') }}"
                class="btn"
                style="
                    background:#6b7280;
                    color:white;
                "
            >
                Batal
            </a>

            <button
                type="submit"
                class="btn btn-primary"
            >
                Simpan Kategori
            </button>

        </div>

    </form>

</div>

@endsection