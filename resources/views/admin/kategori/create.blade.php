@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')

    <h1>Tambah Kategori</h1>

    <p style="color:#6b7280;">
        Tambahkan kategori pengaduan baru.
    </p>

    <div class="card">

        <form
            action="{{ route('admin.kategori.store') }}"
            method="POST"
        >

            @csrf

            <div style="margin-bottom:15px;">

                <label>
                    <strong>Nama Kategori</strong>
                </label>

                <br>

                <input
                    type="text"
                    name="nama_kategori"
                    value="{{ old('nama_kategori') }}"
                    required
                    style="width:100%;padding:10px;margin-top:5px;"
                >

                @error('nama_kategori')
                    <p style="color:red;">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            <div style="margin-bottom:15px;">

                <label>
                    <strong>Deskripsi</strong>
                </label>

                <br>

                <textarea
                    name="deskripsi"
                    rows="4"
                    style="width:100%;padding:10px;margin-top:5px;"
                >{{ old('deskripsi') }}</textarea>

                @error('deskripsi')
                    <p style="color:red;">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            <a
                href="{{ route('admin.kategori.index') }}"
                class="btn"
                style="background:#6b7280;color:white;"
            >
                Batal
            </a>

            <button
                type="submit"
                class="btn btn-primary"
            >
                Simpan
            </button>

        </form>

    </div>

@endsection