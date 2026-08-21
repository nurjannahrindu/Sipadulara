<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    /**
     * Menampilkan pengajuan milik masyarakat.
     */
    public function index()
    {
        $masyarakatId = Auth::guard('masyarakat')->id();

        $pengajuans = Pengajuan::with('kategori')
            ->where('id_masyarakat', $masyarakatId)
            ->latest()
            ->get();

        return view('masyarakat.pengajuan.index', compact('pengajuans'));
    }

    /**
     * Form membuat pengajuan.
     */
    public function create()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('masyarakat.pengajuan.create', compact('kategoris'));
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
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tanggal' => 'required|date',
        ], [
            'id_kategori.required' => 'Kategori wajib dipilih.',
            'id_kategori.exists' => 'Kategori tidak valid.',
            'judul.required' => 'Judul wajib diisi.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'lokasi.required' => 'Lokasi wajib diisi.',
            'latitude.required' => 'Titik lokasi pada peta wajib dipilih.',
            'latitude.numeric' => 'Latitude tidak valid.',
            'longitude.required' => 'Titik lokasi pada peta wajib dipilih.',
            'longitude.numeric' => 'Longitude tidak valid.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Gambar harus JPG, JPEG, PNG, atau WEBP.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
            'tanggal.required' => 'Tanggal wajib diisi.',
        ]);

        $validated['id_masyarakat'] = Auth::guard('masyarakat')->id();

        // Setiap pengajuan baru selalu berstatus diajukan.
        $validated['status'] = 'diajukan';

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')
                ->store('pengajuan', 'public');
        }

        Pengajuan::create($validated);

        return redirect()
            ->route('masyarakat.pengajuan.index')
            ->with('success', 'Pengajuan berhasil dibuat.');
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

        return view('masyarakat.pengajuan.show', compact('pengajuan'));
    }

    /**
     * Form edit pengajuan.
     */
    public function edit(Pengajuan $pengajuan)
    {
        $this->authorizePengajuan($pengajuan);

        // Pengajuan yang sudah diproses tidak boleh diedit.
        if ($pengajuan->status !== 'diajukan') {
            return redirect()
                ->route('masyarakat.pengajuan.index')
                ->with('error', 'Pengajuan yang sudah diproses tidak dapat diedit.');
        }

        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view(
            'masyarakat.pengajuan.edit',
            compact('pengajuan', 'kategoris')
        );
    }

    /**
     * Memperbarui pengajuan.
     */
    public function update(Request $request, Pengajuan $pengajuan)
    {
        $this->authorizePengajuan($pengajuan);

        if ($pengajuan->status !== 'diajukan') {
            return redirect()
                ->route('masyarakat.pengajuan.index')
                ->with('error', 'Pengajuan yang sudah diproses tidak dapat diubah.');
        }

        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'judul' => 'required|string|max:255',
            'keterangan' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tanggal' => 'required|date',
        ]);

        if ($request->hasFile('gambar')) {

            if ($pengajuan->gambar) {
                Storage::disk('public')->delete($pengajuan->gambar);
            }

            $validated['gambar'] = $request->file('gambar')
                ->store('pengajuan', 'public');
        }

        $pengajuan->update($validated);

        return redirect()
            ->route('masyarakat.pengajuan.index')
            ->with('success', 'Pengajuan berhasil diperbarui.');
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
                ->with('error', 'Pengajuan yang sudah diproses tidak dapat dihapus.');
        }

        if ($pengajuan->gambar) {
            Storage::disk('public')->delete($pengajuan->gambar);
        }

        $pengajuan->delete();

        return redirect()
            ->route('masyarakat.pengajuan.index')
            ->with('success', 'Pengajuan berhasil dihapus.');
    }

    /**
     * Memastikan pengajuan memang milik masyarakat yang sedang login.
     */
    private function authorizePengajuan(Pengajuan $pengajuan): void
    {
        if (
            $pengajuan->id_masyarakat !==
            Auth::guard('masyarakat')->id()
        ) {
            abort(403, 'Anda tidak memiliki akses ke pengajuan ini.');
        }
    }
}