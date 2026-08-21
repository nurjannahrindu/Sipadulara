<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penanganan;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PenangananController extends Controller
{
    /**
     * Menampilkan form penanganan.
     */
    public function create(Pengajuan $pengajuan)
    {
        $pengajuan->load([
            'masyarakat',
            'kategori',
        ]);

        return view(
            'admin.penanganan.create',
            compact('pengajuan')
        );
    }

    /**
     * Menyimpan penanganan.
     */
    public function store(Request $request, Pengajuan $pengajuan)
    {
        $validated = $request->validate([
            'status' => 'required|in:diproses,ditangani,selesai,ditolak',
            'tanggal_penanganan' => 'required|date',
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status penanganan tidak valid.',
            'tanggal_penanganan.required' => 'Tanggal penanganan wajib diisi.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
        ]);

        $validated['id_admin'] = Auth::guard('admin')->id();
        $validated['id_pengajuan'] = $pengajuan->id_pengajuan;

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')
                ->store('penanganan', 'public');
        }

        Penanganan::create($validated);

        // Status pengajuan mengikuti status penanganan.
        $pengajuan->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.pengajuan.show', $pengajuan->id_pengajuan)
            ->with('success', 'Penanganan berhasil disimpan.');
    }

    /**
     * Form edit penanganan terakhir.
     */
    public function edit(Penanganan $penanganan)
    {
        $penanganan->load('pengajuan');

        return view(
            'admin.penanganan.edit',
            compact('penanganan')
        );
    }

    /**
     * Memperbarui penanganan.
     */
    public function update(Request $request, Penanganan $penanganan)
    {
        $validated = $request->validate([
            'status' => 'required|in:diproses,ditangani,selesai,ditolak',
            'tanggal_penanganan' => 'required|date',
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {

            if ($penanganan->gambar) {
                Storage::disk('public')->delete($penanganan->gambar);
            }

            $validated['gambar'] = $request->file('gambar')
                ->store('penanganan', 'public');
        }

        $penanganan->update($validated);

        // Sinkronkan status pengajuan.
        $penanganan->pengajuan->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route(
                'admin.pengajuan.show',
                $penanganan->id_pengajuan
            )
            ->with('success', 'Penanganan berhasil diperbarui.');
    }
}