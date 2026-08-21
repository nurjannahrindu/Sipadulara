<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengajuan = Pengajuan::count();

        $diajukan = Pengajuan::where('status', 'diajukan')->count();

        $diproses = Pengajuan::where('status', 'diproses')->count();

        $ditangani = Pengajuan::where('status', 'ditangani')->count();

        $selesai = Pengajuan::where('status', 'selesai')->count();

        $ditolak = Pengajuan::where('status', 'ditolak')->count();

        return view('admin.dashboard', compact(
            'totalPengajuan',
            'diajukan',
            'diproses',
            'ditangani',
            'selesai',
            'ditolak'
        ));
    }
}