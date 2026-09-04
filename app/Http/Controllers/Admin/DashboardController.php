<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | STATISTIK UTAMA
        |--------------------------------------------------------------------------
        */

        $totalPengajuan = Pengajuan::count();

        $diajukan = Pengajuan::where('status', 'diajukan')->count();

        $diproses = Pengajuan::where('status', 'diproses')->count();

        $ditangani = Pengajuan::where('status', 'ditangani')->count();

        $selesai = Pengajuan::where('status', 'selesai')->count();

        $ditolak = Pengajuan::where('status', 'ditolak')->count();

        $totalMasyarakat = Masyarakat::count();


        /*
        |--------------------------------------------------------------------------
        | BULAN DAN TAHUN YANG DIPILIH
        |--------------------------------------------------------------------------
        */

        $bulan = (int) $request->get('bulan', now()->month);

        $tahun = (int) $request->get('tahun', now()->year);

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

        $namaBulanDipilih = $daftarBulan[$bulan] ?? '-';


        /*
        |--------------------------------------------------------------------------
        | PENGAJUAN BULAN TERPILIH
        |--------------------------------------------------------------------------
        */

        $queryBulan = Pengajuan::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun);


        $totalBulan = (clone $queryBulan)->count();

        $bulanDiajukan = (clone $queryBulan)
            ->where('status', 'diajukan')
            ->count();

        $bulanDiproses = (clone $queryBulan)
            ->where('status', 'diproses')
            ->count();

        $bulanDitangani = (clone $queryBulan)
            ->where('status', 'ditangani')
            ->count();

        $bulanSelesai = (clone $queryBulan)
            ->where('status', 'selesai')
            ->count();

        $bulanDitolak = (clone $queryBulan)
            ->where('status', 'ditolak')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | PERSENTASE STATUS
        |--------------------------------------------------------------------------
        */

        $persenDiajukan = $totalBulan > 0
            ? round(($bulanDiajukan / $totalBulan) * 100, 1)
            : 0;

        $persenDiproses = $totalBulan > 0
            ? round(($bulanDiproses / $totalBulan) * 100, 1)
            : 0;

        $persenDitangani = $totalBulan > 0
            ? round(($bulanDitangani / $totalBulan) * 100, 1)
            : 0;

        $persenSelesai = $totalBulan > 0
            ? round(($bulanSelesai / $totalBulan) * 100, 1)
            : 0;

        $persenDitolak = $totalBulan > 0
            ? round(($bulanDitolak / $totalBulan) * 100, 1)
            : 0;


        /*
        |--------------------------------------------------------------------------
        | DATA GRAFIK
        |--------------------------------------------------------------------------
        */

        $grafik = [
            'labels' => [
                'Diajukan',
                'Diproses',
                'Ditangani',
                'Selesai',
                'Ditolak',
            ],

            'data' => [
                $bulanDiajukan,
                $bulanDiproses,
                $bulanDitangani,
                $bulanSelesai,
                $bulanDitolak,
            ],

            'persentase' => [
                $persenDiajukan,
                $persenDiproses,
                $persenDitangani,
                $persenSelesai,
                $persenDitolak,
            ],
        ];


        /*
        |--------------------------------------------------------------------------
        | ARSIP STATISTIK BULANAN
        |--------------------------------------------------------------------------
        |
        | Ambil semua bulan yang memiliki pengajuan.
        |
        */

        $arsipBulanan = Pengajuan::selectRaw('
                YEAR(tanggal) as tahun,
                MONTH(tanggal) as bulan,
                COUNT(*) as total_pengajuan
            ')
            ->groupByRaw('YEAR(tanggal), MONTH(tanggal)')
            ->orderByRaw('YEAR(tanggal) DESC')
            ->orderByRaw('MONTH(tanggal) DESC')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | HITUNG PERSENTASE UNTUK ARSIP
        |--------------------------------------------------------------------------
        */

        foreach ($arsipBulanan as $arsip) {

            $total = $arsip->total_pengajuan;

            $statusDiajukan = Pengajuan::whereYear('tanggal', $arsip->tahun)
                ->whereMonth('tanggal', $arsip->bulan)
                ->where('status', 'diajukan')
                ->count();

            $statusDiproses = Pengajuan::whereYear('tanggal', $arsip->tahun)
                ->whereMonth('tanggal', $arsip->bulan)
                ->where('status', 'diproses')
                ->count();

            $statusDitangani = Pengajuan::whereYear('tanggal', $arsip->tahun)
                ->whereMonth('tanggal', $arsip->bulan)
                ->where('status', 'ditangani')
                ->count();

            $statusSelesai = Pengajuan::whereYear('tanggal', $arsip->tahun)
                ->whereMonth('tanggal', $arsip->bulan)
                ->where('status', 'selesai')
                ->count();

            $statusDitolak = Pengajuan::whereYear('tanggal', $arsip->tahun)
                ->whereMonth('tanggal', $arsip->bulan)
                ->where('status', 'ditolak')
                ->count();


            $arsip->persen_diajukan = $total > 0
                ? round(($statusDiajukan / $total) * 100, 1)
                : 0;

            $arsip->persen_diproses = $total > 0
                ? round(($statusDiproses / $total) * 100, 1)
                : 0;

            $arsip->persen_ditangani = $total > 0
                ? round(($statusDitangani / $total) * 100, 1)
                : 0;

            $arsip->persen_selesai = $total > 0
                ? round(($statusSelesai / $total) * 100, 1)
                : 0;

            $arsip->persen_ditolak = $total > 0
                ? round(($statusDitolak / $total) * 100, 1)
                : 0;
        }


        return view('admin.dashboard', compact(
            'user',
            'totalPengajuan',
            'diajukan',
            'diproses',
            'ditangani',
            'selesai',
            'ditolak',
            'totalMasyarakat',
            'bulan',
            'tahun',
            'namaBulanDipilih',
            'totalBulan',
            'persenDiajukan',
            'persenDiproses',
            'persenDitangani',
            'persenSelesai',
            'persenDitolak',
            'grafik',
            'arsipBulanan'
        ));
    }
}