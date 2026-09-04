@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')

<div class="page-header">

    <div>

        <h1>Edit Kategori</h1>

        <p style="color:#64748b; margin-top:5px;">
            Ubah informasi kategori pengaduan.
        </p>

    </div>

</div>


<div class="card">

    <form
        action="{{ route('admin.kategori.update', $kategori->id_kategori) }}"
        method="POST"
    >

        @csrf

        @method('PUT')


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
                value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                required
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
            >{{ old('keterangan', $kategori->keterangan) }}</textarea>

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
                Update Kategori
            </button>

        </div>

    </form>

</div>

@endsection