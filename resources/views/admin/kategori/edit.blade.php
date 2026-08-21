@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')

    <h1>Edit Kategori</h1>

    <p style="color:#6b7280;">
        Ubah informasi kategori pengaduan.
    </p>

    <div class="card">

        <form
            action="{{ route('admin.kategori.update', $kategori->id_kategori) }}"
            method="POST"
        >

            @csrf

            @method('PUT')

            <div style="margin-bottom:15px;">

                <label>
                    <strong>Nama Kategori</strong>
                </label>

                <br>

                <input
                    type="text"
                    name="nama_kategori"
                    value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
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
                >{{ old('deskripsi', $kategori->deskripsi) }}</textarea>

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
                Update
            </button>

        </form>

    </div>

@endsection