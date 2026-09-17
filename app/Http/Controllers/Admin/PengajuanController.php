<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;

class PengajuanController extends Controller
{
    /**
     * Menampilkan semua pengajuan.
     */
    public function index()
    {
        $pengajuans = Pengajuan::with([
            'masyarakat',
            'kategori'
        ])
        ->latest()
        ->paginate(15);

        return view('admin.pengajuan.index', compact('pengajuans'));
    }

    /**
     * Menampilkan detail pengajuan.
     */
    public function show(Pengajuan $pengajuan)
    {
        $pengajuan->load([
            'masyarakat',
            'kategori',
            'penanganans'
        ]);

        return view('admin.pengajuan.show', compact('pengajuan'));
    }
}