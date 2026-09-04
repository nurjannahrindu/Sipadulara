<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use App\Models\Kategori;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    /**
     * Mengambil ID masyarakat berdasarkan user yang sedang login.
     */
    private function getMasyarakatId(): int
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'masyarakat') {
            abort(403, 'Anda tidak memiliki akses sebagai masyarakat.');
        }

        $masyarakat = Masyarakat::where('user_id', $user->id)->first();

        if (!$masyarakat) {
            abort(
                403,
                'Profil masyarakat belum terhubung dengan akun pengguna.'
            );
        }

        return $masyarakat->id_masyarakat;
    }

    /**
     * Menampilkan pengajuan milik masyarakat.
     */
    public function index()
    {
        $masyarakatId = $this->getMasyarakatId();

        $pengajuans = Pengajuan::with('kategori')
            ->where('id_masyarakat', $masyarakatId)
            ->latest()
            ->get();

        return view(
            'masyarakat.pengajuan.index',
            compact('pengajuans')
        );
    }

    /**
     * Form membuat pengajuan.
     */
    public function create()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view(
            'masyarakat.pengajuan.create',
            compact('kategoris')
        );
    }

    /**
     * Menyimpan pengajuan.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',

            'judul' => 'required|string|max:255',

            'keterangan' => 'required|string',

            'lokasi' => 'required|string|max:255',

            'latitude' => 'required|numeric|between:-90,90',

            'longitude' => 'required|numeric|between:-180,180',

            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',

            'tanggal' => 'required|date',
        ], [
            'id_kategori.required' =>
                'Kategori wajib dipilih.',

            'id_kategori.exists' =>
                'Kategori tidak valid.',

            'judul.required' =>
                'Judul wajib diisi.',

            'keterangan.required' =>
                'Keterangan wajib diisi.',

            'lokasi.required' =>
                'Lokasi wajib diisi.',

            'latitude.required' =>
                'Titik lokasi pada peta wajib dipilih.',

            'latitude.numeric' =>
                'Latitude tidak valid.',

            'longitude.required' =>
                'Titik lokasi pada peta wajib dipilih.',

            'longitude.numeric' =>
                'Longitude tidak valid.',

            'gambar.image' =>
                'File harus berupa gambar.',

            'gambar.mimes' =>
                'Gambar harus JPG, JPEG, PNG, atau WEBP.',

            'gambar.max' =>
                'Ukuran gambar maksimal 5 MB.',

            'tanggal.required' =>
                'Tanggal wajib diisi.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | ID MASYARAKAT
        |--------------------------------------------------------------------------
        */

        $validated['id_masyarakat'] = $this->getMasyarakatId();

        /*
        |--------------------------------------------------------------------------
        | STATUS AWAL
        |--------------------------------------------------------------------------
        */

        $validated['status'] = 'diajukan';

        /*
        |--------------------------------------------------------------------------
        | SIMPAN GAMBAR
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request
                ->file('gambar')
                ->store('pengajuan', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN PENGAJUAN
        |--------------------------------------------------------------------------
        */

        Pengajuan::create($validated);

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('masyarakat.pengajuan.index')
            ->with(
                'success',
                'Pengajuan berhasil dibuat.'
            );
    }

    /**
     * Menampilkan detail pengajuan.
     */
    public function show(Pengajuan $pengajuan)
    {
        $this->authorizePengajuan($pengajuan);

        $pengajuan->load([
            'kategori',
            'penanganans',
        ]);

        return view(
            'masyarakat.pengajuan.show',
            compact('pengajuan')
        );
    }

    /**
     * Form edit pengajuan.
     */
    public function edit(Pengajuan $pengajuan)
    {
        $this->authorizePengajuan($pengajuan);

        if ($pengajuan->status !== 'diajukan') {
            return redirect()
                ->route('masyarakat.pengajuan.index')
                ->with(
                    'error',
                    'Pengajuan yang sudah diproses tidak dapat diedit.'
                );
        }

        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view(
            'masyarakat.pengajuan.edit',
            compact(
                'pengajuan',
                'kategoris'
            )
        );
    }

    /**
     * Memperbarui pengajuan.
     */
    public function update(
        Request $request,
        Pengajuan $pengajuan
    ) {
        $this->authorizePengajuan($pengajuan);

        if ($pengajuan->status !== 'diajukan') {
            return redirect()
                ->route('masyarakat.pengajuan.index')
                ->with(
                    'error',
                    'Pengajuan yang sudah diproses tidak dapat diubah.'
                );
        }

        $validated = $request->validate([
            'id_kategori' =>
                'required|exists:kategori,id_kategori',

            'judul' =>
                'required|string|max:255',

            'keterangan' =>
                'required|string',

            'lokasi' =>
                'required|string|max:255',

            'latitude' =>
                'required|numeric|between:-90,90',

            'longitude' =>
                'required|numeric|between:-180,180',

            'gambar' =>
                'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',

            'tanggal' =>
                'required|date',
        ]);

        /*
        |--------------------------------------------------------------------------
        | GANTI GAMBAR
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('gambar')) {

            if ($pengajuan->gambar) {
                Storage::disk('public')
                    ->delete($pengajuan->gambar);
            }

            $validated['gambar'] = $request
                ->file('gambar')
                ->store('pengajuan', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $pengajuan->update($validated);

        return redirect()
            ->route('masyarakat.pengajuan.index')
            ->with(
                'success',
                'Pengajuan berhasil diperbarui.'
            );
    }

    /**
     * Menghapus pengajuan.
     */
    public function destroy(Pengajuan $pengajuan)
    {
        $this->authorizePengajuan($pengajuan);

        if ($pengajuan->status !== 'diajukan') {
            return redirect()
                ->route('masyarakat.pengajuan.index')
                ->with(
                    'error',
                    'Pengajuan yang sudah diproses tidak dapat dihapus.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | HAPUS GAMBAR
        |--------------------------------------------------------------------------
        */

        if ($pengajuan->gambar) {
            Storage::disk('public')
                ->delete($pengajuan->gambar);
        }

        /*
        |--------------------------------------------------------------------------
        | HAPUS DATA
        |--------------------------------------------------------------------------
        */

        $pengajuan->delete();

        return redirect()
            ->route('masyarakat.pengajuan.index')
            ->with(
                'success',
                'Pengajuan berhasil dihapus.'
            );
    }

    /**
     * Memastikan pengajuan milik masyarakat yang login.
     */
    private function authorizePengajuan(
        Pengajuan $pengajuan
    ): void {

        $masyarakatId = $this->getMasyarakatId();

        if ($pengajuan->id_masyarakat !== $masyarakatId) {
            abort(
                403,
                'Anda tidak memiliki akses ke pengajuan ini.'
            );
        }
    }
}