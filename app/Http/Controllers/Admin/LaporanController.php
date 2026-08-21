<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;

class LaporanController extends Controller
{
    /**
     * Menampilkan halaman laporan
     */
    public function index()
    {
        $pengajuans = Pengajuan::with([
            'masyarakat',
            'kategori',
            'penanganans.admin',
        ])
        ->latest('tanggal')
        ->get();

        return view(
            'admin.laporan.index',
            compact('pengajuans')
        );
    }


    /**
     * Menampilkan halaman khusus untuk cetak laporan
     */
    public function cetak()
    {
        $pengajuans = Pengajuan::with([
            'masyarakat',
            'kategori',
            'penanganans.admin',
        ])
        ->latest('tanggal')
        ->get();

        return view(
            'admin.laporan.cetak',
            compact('pengajuans')
        );
    }
}