<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $masyarakat = Masyarakat::findOrFail(
            Auth::guard('masyarakat')->id()
        );

        $totalPengajuan = $masyarakat->pengajuans()->count();

        $diajukan = $masyarakat->pengajuans()
            ->where('status', 'diajukan')
            ->count();

        $diproses = $masyarakat->pengajuans()
            ->where('status', 'diproses')
            ->count();

        $selesai = $masyarakat->pengajuans()
            ->where('status', 'selesai')
            ->count();

        return view('masyarakat.dashboard', compact(
            'masyarakat',
            'totalPengajuan',
            'diajukan',
            'diproses',
            'selesai'
        ));
    }
}