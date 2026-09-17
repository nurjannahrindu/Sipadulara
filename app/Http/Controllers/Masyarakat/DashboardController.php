<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $masyarakat = Masyarakat::where('user_id', $user->id)->first();

        if (!$masyarakat) {
            abort(403, 'Profil masyarakat belum terhubung dengan akun pengguna.');
        }

        $query = Pengajuan::where('id_masyarakat', $masyarakat->id_masyarakat);

        $totalPengajuan = (clone $query)->count();
        $diajukan = (clone $query)->where('status', 'diajukan')->count();
        $diproses = (clone $query)->where('status', 'diproses')->count();
        $selesai = (clone $query)->where('status', 'selesai')->count();
        $ditolak = (clone $query)->where('status', 'ditolak')->count();

        return view('masyarakat.dashboard', compact(
            'user',
            'masyarakat',
            'totalPengajuan',
            'diajukan',
            'diproses',
            'selesai',
            'ditolak'
        ));
    }
}