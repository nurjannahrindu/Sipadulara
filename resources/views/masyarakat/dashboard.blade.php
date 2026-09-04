@extends('layouts.masyarakat')

@section('title', 'Dashboard Masyarakat')

@section('content')

<div style="margin-bottom: 25px;">

    <h1 class="page-title">
        Dashboard Masyarakat
    </h1>

    <p class="page-description">
        Selamat datang di SIPADULARA, {{ $masyarakat->nama }}.
    </p>

</div>


{{-- ============================================
     STATISTIK PENGAJUAN
============================================= --}}

<div class="stats">

    {{-- TOTAL PENGAJUAN --}}
    <div class="stat-card">

        <div class="stat-title">
             Total Pengajuan
        </div>

        <div class="stat-number">
            {{ $totalPengajuan }}
        </div>

        <div class="stat-description">
            Seluruh pengajuan kamu
        </div>

    </div>


    {{-- DIAJUKAN --}}
    <div class="stat-card">

        <div class="stat-title">
             Diajukan
        </div>

        <div class="stat-number">
            {{ $diajukan }}
        </div>

        <div class="stat-description">
            Pengajuan menunggu proses
        </div>

    </div>


    {{-- DIPROSES --}}
    <div class="stat-card">

        <div class="stat-title">
             Diproses
        </div>

        <div class="stat-number">
            {{ $diproses }}
        </div>

        <div class="stat-description">
            Pengajuan sedang diproses
        </div>

    </div>


    {{-- DITANGANI --}}
    <div class="stat-card">

        <div class="stat-title">
            Ditangani
        </div>

        <div class="stat-number">
            {{ $ditangani }}
        </div>

        <div class="stat-description">
            Pengajuan sedang ditangani
        </div>

    </div>


    {{-- SELESAI --}}
    <div class="stat-card">

        <div class="stat-title">
             Selesai
        </div>

        <div class="stat-number">
            {{ $selesai }}
        </div>

        <div class="stat-description">
            Pengajuan telah selesai
        </div>

    </div>


    {{-- DITOLAK --}}
    <div class="stat-card">

        <div class="stat-title">
             Ditolak
        </div>

        <div class="stat-number">
            {{ $ditolak }}
        </div>

        <div class="stat-description">
            Pengajuan ditolak
        </div>

    </div>

</div>


{{-- ============================================
     BUAT PENGADUAN
============================================= --}}

<div class="card" style="margin-top: 25px;">

    <h2 style="margin-top:0; color:#0f172a;">
        Buat Pengaduan
    </h2>

    <p style="color:#64748b;">
        Jika kamu ingin menyampaikan pengaduan kepada pemerintah,
        silakan buat pengajuan baru melalui menu
        <strong>Pengajuan Saya</strong>.
    </p>

</div>

@endsection