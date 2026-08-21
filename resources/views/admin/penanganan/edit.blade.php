@extends('layouts.admin')

@section('title', 'Edit Penanganan')

@section('content')

    <div style="margin-bottom: 20px;">

        <h1 style="margin: 0;">
            Edit Penanganan
        </h1>

        <p style="color: #6b7280;">
            Perbarui informasi penanganan pengajuan.
        </p>

    </div>


    {{-- INFORMASI PENGAJUAN --}}

    <div class="card" style="margin-bottom: 20px;">

        <h2>Informasi Pengajuan</h2>

        <p>
            <strong>Judul:</strong><br>
            {{ $penanganan->pengajuan->judul }}
        </p>

        <p>
            <strong>Lokasi:</strong><br>
            {{ $penanganan->pengajuan->lokasi }}
        </p>

    </div>


    {{-- FORM EDIT --}}

    <div class="card">

        <form
            action="{{ route('admin.penanganan.update', $penanganan->id_penanganan) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            @method('PUT')


            {{-- STATUS --}}

            <div style="margin-bottom: 20px;">

                <label for="status">
                    <strong>Status Penanganan</strong>
                </label>

                <br>

                <select
                    name="status"
                    id="status"
                    required
                    style="
                        width: 100%;
                        padding: 10px;
                        margin-top: 5px;
                    "
                >

                    <option
                        value="diproses"
                        {{ old('status', $penanganan->status) === 'diproses' ? 'selected' : '' }}
                    >
                        Diproses
                    </option>

                    <option
                        value="ditangani"
                        {{ old('status', $penanganan->status) === 'ditangani' ? 'selected' : '' }}
                    >
                        Ditangani
                    </option>

                    <option
                        value="selesai"
                        {{ old('status', $penanganan->status) === 'selesai' ? 'selected' : '' }}
                    >
                        Selesai
                    </option>

                    <option
                        value="ditolak"
                        {{ old('status', $penanganan->status) === 'ditolak' ? 'selected' : '' }}
                    >
                        Ditolak
                    </option>

                </select>

                @error('status')

                    <p style="color:red;">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- TANGGAL --}}

            <div style="margin-bottom: 20px;">

                <label for="tanggal_penanganan">
                    <strong>Tanggal Penanganan</strong>
                </label>

                <br>

                <input
                    type="date"
                    name="tanggal_penanganan"
                    id="tanggal_penanganan"
                    value="{{ old('tanggal_penanganan', $penanganan->tanggal_penanganan?->format('Y-m-d')) }}"
                    required
                    style="
                        width: 100%;
                        padding: 10px;
                        margin-top: 5px;
                    "
                >

                @error('tanggal_penanganan')

                    <p style="color:red;">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- KETERANGAN --}}

            <div style="margin-bottom: 20px;">

                <label for="keterangan">
                    <strong>Keterangan</strong>
                </label>

                <br>

                <textarea
                    name="keterangan"
                    id="keterangan"
                    rows="5"
                    placeholder="Masukkan keterangan penanganan..."
                    style="
                        width: 100%;
                        padding: 10px;
                        margin-top: 5px;
                        resize: vertical;
                    "
                >{{ old('keterangan', $penanganan->keterangan) }}</textarea>

                @error('keterangan')

                    <p style="color:red;">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- GAMBAR LAMA --}}

            @if ($penanganan->gambar)

                <div style="margin-bottom: 20px;">

                    <label>
                        <strong>Foto Penanganan Saat Ini</strong>
                    </label>

                    <br>

                    <img
                        src="{{ asset('storage/' . $penanganan->gambar) }}"
                        alt="Foto Penanganan"
                        style="
                            max-width: 400px;
                            width: 100%;
                            margin-top: 10px;
                            border-radius: 8px;
                        "
                    >

                </div>

            @endif


            {{-- GAMBAR BARU --}}

            <div style="margin-bottom: 20px;">

                <label for="gambar">
                    <strong>
                        {{ $penanganan->gambar ? 'Ganti Foto Penanganan' : 'Foto Penanganan' }}
                    </strong>
                </label>

                <br>

                <input
                    type="file"
                    name="gambar"
                    id="gambar"
                    accept="image/*"
                    style="
                        margin-top: 8px;
                    "
                >

                <p style="color:#6b7280;font-size:14px;">
                    Kosongkan jika tidak ingin mengganti foto.
                </p>

                @error('gambar')

                    <p style="color:red;">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- TOMBOL --}}

            <div>

                <a
                    href="{{ route('admin.pengajuan.show', $penanganan->id_pengajuan) }}"
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
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

@endsection