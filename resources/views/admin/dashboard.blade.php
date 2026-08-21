@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')

    <h1>Dashboard Admin</h1>

    <p>
        Selamat datang di SIPADULARA.
    </p>

    <div class="card">

        <h3>Statistik Pengajuan</h3>

        <p>
            Total Pengajuan:
            <strong>{{ $totalPengajuan }}</strong>
        </p>

        <p>
            Diajukan:
            <strong>{{ $diajukan }}</strong>
        </p>

        <p>
            Diproses:
            <strong>{{ $diproses }}</strong>
        </p>

        <p>
            Ditangani:
            <strong>{{ $ditangani }}</strong>
        </p>

        <p>
            Selesai:
            <strong>{{ $selesai }}</strong>
        </p>

        <p>
            Ditolak:
            <strong>{{ $ditolak }}</strong>
        </p>

    </div>

@endsection