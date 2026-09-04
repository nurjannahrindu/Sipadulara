<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use App\Models\Pengajuan;

class LandingController extends Controller
{
    public function index()
    {
        $totalMasyarakat = Masyarakat::count();

        $totalPengajuan = Pengajuan::count();

        $diproses = Pengajuan::where('status', 'diproses')->count();

        $ditangani = Pengajuan::where('status', 'ditangani')->count();

        $selesai = Pengajuan::where('status', 'selesai')->count();

        $ditolak = Pengajuan::where('status', 'ditolak')->count();

        return view('landing', compact(
            'totalMasyarakat',
            'totalPengajuan',
            'diproses',
            'ditangani',
            'selesai',
            'ditolak'
        ));
    }
}