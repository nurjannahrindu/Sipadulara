@extends('layouts.admin')

@section('title', 'Dashboard Admin')


@section('styles')

<style>

    /* =====================================================
       DASHBOARD WRAPPER
    ===================================================== */

    .dashboard-wrapper {
        width: 100%;
    }


    /* =====================================================
       HEADER
    ===================================================== */

    .dashboard-header {

        margin-bottom: 24px;
    }


    .dashboard-header h1 {

        margin: 0;

        color: #0f172a;

        font-size: 30px;

        font-weight: 800;

        letter-spacing: -.4px;
    }


    .dashboard-header p {

        margin: 8px 0 0;

        color: #64748b;

        font-size: 14px;

        line-height: 1.6;
    }


    /* =====================================================
       STATISTIK
    ===================================================== */
    .stats-grid {

        display: grid;

        grid-template-columns:
            repeat(6, minmax(0, 1fr));

        gap: 14px;

        margin-bottom: 25px;
    }


    .stat-card {

        position: relative;

        overflow: hidden;

        min-height: 135px;

        background: #ffffff;

        border: 1px solid #e5eaf1;

        border-radius: 13px;

        padding: 17px;

        box-shadow:
            0 5px 18px rgba(15, 23, 42, .045);

        transition:
            transform .2s ease,
            box-shadow .2s ease;
    }


    .stat-card:hover {

        transform: translateY(-3px);

        box-shadow:
            0 10px 25px rgba(15, 23, 42, .08);
    }


    .stat-card::after {

        content: "";

        position: absolute;

        right: -30px;

        bottom: -35px;

        width: 105px;

        height: 105px;

        border-radius: 50%;

        background: #eff6ff;

        opacity: .8;
    }


    .stat-top {

        position: relative;

        z-index: 2;

        display: flex;

        justify-content: space-between;

        align-items: center;

        margin-bottom: 14px;
    }


    .stat-icon {

        width: 46px;

        height: 46px;

        border-radius: 12px;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 20px;

        flex-shrink: 0;
    }


    .icon-blue {

        background: #dbeafe;

        color: #2563eb;
    }


    .icon-yellow {

        background: #fef3c7;

        color: #d97706;
    }


    .icon-purple {

        background: #ede9fe;

        color: #7c3aed;
    }


    .icon-orange {

        background: #ffedd5;

        color: #ea580c;
    }


    .icon-green {

        background: #dcfce7;

        color: #16a34a;
    }


    .icon-red {

        background: #fee2e2;

        color: #dc2626;
    }


    .stat-label {

        color: #64748b;

        font-size: 13px;

        font-weight: 600;
    }


    .stat-number {

        position: relative;

        z-index: 2;

        color: #0f172a;

        font-size: 27px;

        font-weight: 800;

        line-height: 1;
    }


    .stat-description {

        position: relative;

        z-index: 2;

        margin-top: 9px;

        color: #94a3b8;

        font-size: 10px;

        line-height: 1.45;
    }


    /* =====================================================
       CARD DASHBOARD
    ===================================================== */

    .dashboard-card {

        background: #ffffff;

        border: 1px solid #e5eaf1;

        border-radius: 13px;

        padding: 26px;

        margin-bottom: 24px;

        box-shadow:
            0 5px 18px rgba(15, 23, 42, .04);
    }


    .card-title {

        margin: 0;

        color: #0f172a;

        font-size: 20px;

        font-weight: 700;
    }


    .card-subtitle {

        margin: 6px 0 0;

        color: #64748b;

        font-size: 13px;
    }


    /* =====================================================
       GRAFIK HEADER
    ===================================================== */

    .chart-header {

        display: flex;

        justify-content: space-between;

        align-items: flex-start;

        gap: 20px;

        margin-bottom: 25px;
    }


    .filter-form {

        display: flex;

        align-items: center;

        gap: 8px;
    }


    .filter-form select {

        height: 38px;

        padding: 0 12px;

        border: 1px solid #cbd5e1;

        border-radius: 9px;

        background: #ffffff;

        color: #334155;

        font-family: inherit;

        font-size: 13px;

        outline: none;
    }


    .filter-form select:focus {

        border-color: #2563eb;

        box-shadow:
            0 0 0 3px rgba(37, 99, 235, .10);
    }


    .filter-button {

        height: 38px;

        padding: 0 16px;

        border: none;

        border-radius: 9px;

        background: #2563eb;

        color: #ffffff;

        font-size: 13px;

        font-weight: 600;

        cursor: pointer;

        transition: .2s;
    }


    .filter-button:hover {

        background: #1d4ed8;

        transform: translateY(-1px);
    }


    /* =====================================================
       GRAFIK
    ===================================================== */

    .chart-box {

        width: 100%;

        height: 350px;

        position: relative;
    }


    /* =====================================================
       PERSENTASE
    ===================================================== */

    .percentage-title {

        margin-top: 28px;

        margin-bottom: 15px;

        color: #334155;

        font-size: 15px;

        font-weight: 700;
    }


    .percentage-grid {

        display: grid;

        grid-template-columns:
            repeat(5, minmax(0, 1fr));

        gap: 12px;
    }


    .percentage-card {

        background: #f8fafc;

        border: 1px solid #e2e8f0;

        border-radius: 12px;

        padding: 15px;
    }


    .percentage-name {

        color: #64748b;

        font-size: 12px;

        margin-bottom: 7px;
    }


    .percentage-number {

        color: #0f172a;

        font-size: 20px;

        font-weight: 700;
    }


    .progress {

        height: 6px;

        margin-top: 10px;

        background: #e2e8f0;

        border-radius: 10px;

        overflow: hidden;
    }


    .progress-bar {

        height: 100%;

        background: #2563eb;

        border-radius: 10px;

        transition: width .4s ease;
    }


    /* =====================================================
       ARSIP
    ===================================================== */

    .archive-header {

        display: flex;

        justify-content: space-between;

        align-items: center;

        gap: 15px;

        margin-bottom: 20px;
    }


    .archive-count {

        background: #eff6ff;

        color: #2563eb;

        padding: 7px 12px;

        border-radius: 20px;

        font-size: 12px;

        font-weight: 600;

        white-space: nowrap;
    }


    .archive-table-wrapper {

        width: 100%;

        overflow-x: auto;
    }


    .archive-table {

        width: 100%;

        min-width: 850px;

        border-collapse: collapse;
    }


    .archive-table th {

        background: #f8fafc;

        color: #64748b;

        font-size: 12px;

        font-weight: 600;

        text-align: left;

        padding: 13px 14px;

        border-bottom: 1px solid #e2e8f0;
    }


    .archive-table td {

        color: #334155;

        font-size: 13px;

        padding: 15px 14px;

        border-bottom: 1px solid #f1f5f9;
    }


    .archive-table tr:hover td {

        background: #f8fafc;
    }


    .month-name {

        font-weight: 600;

        color: #0f172a;
    }


    .percentage-text {

        font-weight: 600;

        color: #2563eb;
    }


    .view-button {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        padding: 7px 12px;

        background: #eff6ff;

        color: #2563eb;

        border-radius: 7px;

        text-decoration: none;

        font-size: 12px;

        font-weight: 600;

        transition: .2s;
    }


    .view-button:hover {

        background: #dbeafe;
    }


    .empty-archive {

        text-align: center;

        padding: 40px 20px;

        color: #94a3b8;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 1100px) {

        .stats-grid {

            grid-template-columns:
                repeat(3, minmax(0, 1fr));
        }


        .percentage-grid {

            grid-template-columns:
                repeat(2, minmax(0, 1fr));
        }

    }


    @media (max-width: 750px) {

        .dashboard-header h1 {

            font-size: 24px;
        }


        .stats-grid {

            grid-template-columns: 1fr;
        }


        .percentage-grid {

            grid-template-columns: 1fr;
        }


        .chart-header {

            flex-direction: column;
        }


        .filter-form {

            width: 100%;

            flex-wrap: wrap;
        }


        .filter-form select {

            flex: 1;

            min-width: 120px;
        }


        .filter-button {

            flex: 1;

            min-width: 100px;
        }


        .chart-box {

            height: 280px;
        }


        .dashboard-card {

            padding: 20px;
        }


        .archive-header {

            align-items: flex-start;

            flex-direction: column;
        }

    }

</style>

@endsection


@section('content')

<div class="dashboard-wrapper">


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="dashboard-header">

        <p>
            Pantau dan kelola perkembangan pengajuan masyarakat melalui SIPADULARA.
        </p>

    </div>


    {{-- =====================================================
         STATISTIK UTAMA
    ====================================================== --}}

    <div class="stats-grid">


        {{-- TOTAL PENGAJUAN --}}

        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-label">
                    Total Pengajuan
                </div>


            </div>

            <div class="stat-number">
                {{ $totalPengajuan }}
            </div>

            <div class="stat-description">
                Seluruh pengajuan masyarakat
            </div>

        </div>


        {{-- DIAJUKAN --}}

        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-label">
                    Diajukan
                </div>

            </div>

            <div class="stat-number">
                {{ $diajukan }}
            </div>

            <div class="stat-description">
                Pengajuan yang baru masuk
            </div>

        </div>


        {{-- DIPROSES --}}

        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-label">
                    Sedang Diproses
                </div>
            </div>

            <div class="stat-number">
                {{ $diproses }}
            </div>

            <div class="stat-description">
                Pengajuan dalam proses
            </div>

        </div>


        {{-- DITANGANI --}}

        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-label">
                    Ditangani
                </div>
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

            <div class="stat-top">

                <div class="stat-label">
                    Selesai
                </div>
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

            <div class="stat-top">

                <div class="stat-label">
                    Ditolak
                </div>

            </div>

            <div class="stat-number">
                {{ $ditolak }}
            </div>

            <div class="stat-description">
                Pengajuan yang ditolak
            </div>

        </div>


    </div>


    {{-- =====================================================
         GRAFIK
    ====================================================== --}}

    <div class="dashboard-card">


        <div class="chart-header">

            <div>

                <h2 class="card-title">
                    Statistik Pengajuan
                </h2>

                <p class="card-subtitle">

                    {{ $namaBulanDipilih }}
                    {{ $tahun }}

                    ·

                    {{ $totalBulan }}
                    total pengajuan

                </p>

            </div>


            {{-- FILTER --}}

            <form
                method="GET"
                action="{{ route('admin.dashboard') }}"
                class="filter-form"
            >

                @php

                    $daftarBulan = [
                        1 => 'Januari',
                        2 => 'Februari',
                        3 => 'Maret',
                        4 => 'April',
                        5 => 'Mei',
                        6 => 'Juni',
                        7 => 'Juli',
                        8 => 'Agustus',
                        9 => 'September',
                        10 => 'Oktober',
                        11 => 'November',
                        12 => 'Desember',
                    ];

                @endphp


                <select name="bulan">

                    @foreach($daftarBulan as $nomor => $nama)

                        <option
                            value="{{ $nomor }}"
                            {{ $bulan == $nomor ? 'selected' : '' }}
                        >
                            {{ $nama }}
                        </option>

                    @endforeach

                </select>


                <select name="tahun">

                    @for(
                        $i = now()->year;
                        $i >= now()->year - 5;
                        $i--
                    )

                        <option
                            value="{{ $i }}"
                            {{ $tahun == $i ? 'selected' : '' }}
                        >
                            {{ $i }}
                        </option>

                    @endfor

                </select>


                <button
                    type="submit"
                    class="filter-button"
                >
                    Tampilkan
                </button>

            </form>

        </div>


        {{-- GRAFIK --}}

        <div class="chart-box">

            <canvas id="statistikChart"></canvas>

        </div>


        {{-- PERSENTASE --}}

        <div class="percentage-title">
            Persentase Status Pengajuan
        </div>


        <div class="percentage-grid">


            {{-- DIAJUKAN --}}

            <div class="percentage-card">

                <div class="percentage-name">
                    Diajukan
                </div>

                <div class="percentage-number">
                    {{ $persenDiajukan }}%
                </div>

                <div class="progress">

                    <div
                        class="progress-bar"
                        style="width: {{ min($persenDiajukan, 100) }}%"
                    ></div>

                </div>

            </div>


            {{-- DIPROSES --}}

            <div class="percentage-card">

                <div class="percentage-name">
                    Diproses
                </div>

                <div class="percentage-number">
                    {{ $persenDiproses }}%
                </div>

                <div class="progress">

                    <div
                        class="progress-bar"
                        style="width: {{ min($persenDiproses, 100) }}%"
                    ></div>

                </div>

            </div>


            {{-- DITANGANI --}}

            <div class="percentage-card">

                <div class="percentage-name">
                    Ditangani
                </div>

                <div class="percentage-number">
                    {{ $persenDitangani }}%
                </div>

                <div class="progress">

                    <div
                        class="progress-bar"
                        style="width: {{ min($persenDitangani, 100) }}%"
                    ></div>

                </div>

            </div>


            {{-- SELESAI --}}

            <div class="percentage-card">

                <div class="percentage-name">
                    Selesai
                </div>

                <div class="percentage-number">
                    {{ $persenSelesai }}%
                </div>

                <div class="progress">

                    <div
                        class="progress-bar"
                        style="width: {{ min($persenSelesai, 100) }}%"
                    ></div>

                </div>

            </div>


            {{-- DITOLAK --}}

            <div class="percentage-card">

                <div class="percentage-name">
                    Ditolak
                </div>

                <div class="percentage-number">
                    {{ $persenDitolak }}%
                </div>

                <div class="progress">

                    <div
                        class="progress-bar"
                        style="width: {{ min($persenDitolak, 100) }}%"
                    ></div>

                </div>

            </div>


        </div>

    </div>


    {{-- =====================================================
         ARSIP BULANAN
    ====================================================== --}}

    <div class="dashboard-card">


        <div class="archive-header">

            <div>

                <h2 class="card-title">
                    Arsip Statistik Bulanan
                </h2>

                <p class="card-subtitle">
                    Riwayat statistik pengajuan setiap bulan.
                </p>

            </div>


            <div class="archive-count">

                {{ $arsipBulanan->count() }}
                Bulan

            </div>

        </div>


        @if($arsipBulanan->count() > 0)


            <div class="archive-table-wrapper">

                <table class="archive-table">

                    <thead>

                        <tr>

                            <th>
                                Bulan
                            </th>

                            <th>
                                Total
                            </th>

                            <th>
                                Diajukan
                            </th>

                            <th>
                                Diproses
                            </th>

                            <th>
                                Ditangani
                            </th>

                            <th>
                                Selesai
                            </th>

                            <th>
                                Ditolak
                            </th>

                            <th>
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($arsipBulanan as $arsip)

                            @php

                                $namaBulanArsip =
                                    $daftarBulan[$arsip->bulan] ?? '-';

                            @endphp


                            <tr>

                                <td>

                                    <div class="month-name">

                                        {{ $namaBulanArsip }}
                                        {{ $arsip->tahun }}

                                    </div>

                                </td>


                                <td>

                                    <strong>
                                        {{ $arsip->total_pengajuan }}
                                    </strong>

                                </td>


                                <td>

                                    <span class="percentage-text">
                                        {{ $arsip->persen_diajukan }}%
                                    </span>

                                </td>


                                <td>

                                    <span class="percentage-text">
                                        {{ $arsip->persen_diproses }}%
                                    </span>

                                </td>


                                <td>

                                    <span class="percentage-text">
                                        {{ $arsip->persen_ditangani }}%
                                    </span>

                                </td>


                                <td>

                                    <span class="percentage-text">
                                        {{ $arsip->persen_selesai }}%
                                    </span>

                                </td>


                                <td>

                                    <span class="percentage-text">
                                        {{ $arsip->persen_ditolak }}%
                                    </span>

                                </td>


                                <td>

                                    <a
                                        href="{{ route('admin.dashboard', [
                                            'bulan' => $arsip->bulan,
                                            'tahun' => $arsip->tahun
                                        ]) }}"
                                        class="view-button"
                                    >
                                        Lihat
                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


        @else

            <div class="empty-archive">

                📂 Belum ada arsip statistik bulanan.

            </div>

        @endif


    </div>


</div>

@endsection


@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const canvas =
        document.getElementById('statistikChart');


    if (!canvas) {

        return;

    }


    const labels =
        @json($grafik['labels']);


    const data =
        @json($grafik['data']);


    const persentase =
        @json($grafik['persentase']);


    new Chart(canvas, {

        type: 'bar',


        data: {

            labels: labels,


            datasets: [

                {

                    label: 'Jumlah Pengajuan',

                    data: data,

                    borderWidth: 0,

                    borderRadius: 8,

                    maxBarThickness: 55

                }

            ]

        },


        options: {

            responsive: true,

            maintainAspectRatio: false,


            interaction: {

                intersect: false,

                mode: 'index'

            },


            plugins: {

                legend: {

                    display: false

                },


                tooltip: {

                    padding: 12,


                    callbacks: {

                        label: function(context) {

                            const index =
                                context.dataIndex;


                            return [

                                'Jumlah: ' +
                                data[index],

                                'Persentase: ' +
                                persentase[index] +
                                '%'

                            ];

                        }

                    }

                }

            },


            scales: {

                x: {

                    grid: {

                        display: false

                    },

                    ticks: {

                        color: '#64748b'

                    }

                },


                y: {

                    beginAtZero: true,


                    ticks: {

                        precision: 0,

                        color: '#64748b'

                    },


                    grid: {

                        color: '#e2e8f0'

                    }

                }

            }

        }

    });

});

</script>

@endsection