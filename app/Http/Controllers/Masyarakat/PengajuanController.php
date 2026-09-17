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
     * ==========================================================
     * MENAMPILKAN DAFTAR PENGAJUAN
     * ==========================================================
     *
     * Maksimal 15 pengajuan ditampilkan dalam satu halaman.
     *
     * Jika jumlah data <= 15:
     * - Tidak ada tombol pagination.
     *
     * Jika jumlah data > 15:
     * - Muncul halaman 1, 2, 3, dst.
     * - Muncul tombol Sebelumnya dan Berikutnya.
     *
     * Data kategori juga dikirim ke halaman index karena
     * modal edit pengajuan berada di halaman index.
     */
    public function index()
    {
        $masyarakatId = $this->getMasyarakatId();

        /*
        |----------------------------------------------------------
        | DATA PENGAJUAN
        |----------------------------------------------------------
        |
        | 15 data per halaman.
        |
        */

        $pengajuans = Pengajuan::with([
                'kategori',
            ])
            ->where(
                'id_masyarakat',
                $masyarakatId
            )
            ->latest()
            ->paginate(15);


        /*
        |----------------------------------------------------------
        | DATA KATEGORI
        |----------------------------------------------------------
        |
        | Dibutuhkan oleh modal:
        | Edit Pengajuan
        |
        */

        $kategoris = Kategori::orderBy(
            'nama_kategori'
        )->get();


        /*
        |----------------------------------------------------------
        | KIRIM DATA KE VIEW
        |----------------------------------------------------------
        */

        return view(
            'masyarakat.pengajuan.index',
            compact(
                'pengajuans',
                'kategoris'
            )
        );
    }


    /**
     * ==========================================================
     * FORM MEMBUAT PENGAJUAN
     * ==========================================================
     */
    public function create()
    {
        $kategoris = Kategori::orderBy(
            'nama_kategori'
        )->get();

        return view(
            'masyarakat.pengajuan.create',
            compact('kategoris')
        );
    }


    /**
     * ==========================================================
     * MENYIMPAN PENGAJUAN
     * ==========================================================
     */
    public function store(Request $request)
    {
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
        |----------------------------------------------------------
        | ID MASYARAKAT
        |----------------------------------------------------------
        */

        $validated['id_masyarakat'] =
            $this->getMasyarakatId();


        /*
        |----------------------------------------------------------
        | STATUS AWAL
        |----------------------------------------------------------
        */

        $validated['status'] = 'diajukan';


        /*
        |----------------------------------------------------------
        | SIMPAN GAMBAR
        |----------------------------------------------------------
        */

        if ($request->hasFile('gambar')) {

            $validated['gambar'] =
                $request
                    ->file('gambar')
                    ->store(
                        'pengajuan',
                        'public'
                    );
        }


        /*
        |----------------------------------------------------------
        | SIMPAN DATA
        |----------------------------------------------------------
        */

        Pengajuan::create($validated);


        /*
        |----------------------------------------------------------
        | KEMBALI KE INDEX
        |----------------------------------------------------------
        */

        return redirect()
            ->route('masyarakat.pengajuan.index')
            ->with(
                'success',
                'Pengajuan berhasil dibuat.'
            );
    }


    /**
     * ==========================================================
     * DETAIL PENGAJUAN
     * ==========================================================
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
     * ==========================================================
     * EDIT PENGAJUAN
     * ==========================================================
     *
     * METHOD INI TIDAK LAGI DIPAKAI UNTUK MEMBUKA HALAMAN EDIT
     * JIKA EDIT SUDAH MENGGUNAKAN MODAL.
     *
     * Tetapi tetap disediakan supaya route edit tidak error.
     */
    public function edit(Pengajuan $pengajuan)
    {
        $this->authorizePengajuan($pengajuan);

        if ($pengajuan->status !== 'diajukan') {

            return redirect()
                ->route(
                    'masyarakat.pengajuan.index'
                )
                ->with(
                    'error',
                    'Pengajuan yang sudah diproses tidak dapat diedit.'
                );
        }

        /*
        |----------------------------------------------------------
        | Jika route edit masih dipanggil,
        | arahkan kembali ke halaman index.
        |----------------------------------------------------------
        */

        return redirect()
            ->route(
                'masyarakat.pengajuan.index'
            )
            ->with(
                'open_edit',
                $pengajuan->id_pengajuan
            );
    }


    /**
     * ==========================================================
     * UPDATE PENGAJUAN
     * ==========================================================
     *
     * Form modal edit akan mengarah ke method ini.
     */
    public function update(
        Request $request,
        Pengajuan $pengajuan
    ) {
        $this->authorizePengajuan($pengajuan);


        /*
        |----------------------------------------------------------
        | CEK STATUS
        |----------------------------------------------------------
        */

        if ($pengajuan->status !== 'diajukan') {

            return redirect()
                ->route(
                    'masyarakat.pengajuan.index'
                )
                ->with(
                    'error',
                    'Pengajuan yang sudah diproses tidak dapat diubah.'
                );
        }


        /*
        |----------------------------------------------------------
        | VALIDASI
        |----------------------------------------------------------
        */

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

            'longitude.required' =>
                'Titik lokasi pada peta wajib dipilih.',

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
        |----------------------------------------------------------
        | GANTI GAMBAR
        |----------------------------------------------------------
        */

        if ($request->hasFile('gambar')) {

            /*
            | Hapus gambar lama
            */

            if ($pengajuan->gambar) {

                Storage::disk('public')
                    ->delete(
                        $pengajuan->gambar
                    );
            }


            /*
            | Simpan gambar baru
            */

            $validated['gambar'] =
                $request
                    ->file('gambar')
                    ->store(
                        'pengajuan',
                        'public'
                    );
        }


        /*
        |----------------------------------------------------------
        | UPDATE DATA
        |----------------------------------------------------------
        */

        $pengajuan->update($validated);


        /*
        |----------------------------------------------------------
        | KEMBALI KE INDEX
        |----------------------------------------------------------
        */

        return redirect()
            ->route(
                'masyarakat.pengajuan.index'
            )
            ->with(
                'success',
                'Pengajuan berhasil diperbarui.'
            );
    }


    /**
     * ==========================================================
     * HAPUS PENGAJUAN
     * ==========================================================
     */
    public function destroy(Pengajuan $pengajuan)
    {
        $this->authorizePengajuan($pengajuan);


        /*
        |----------------------------------------------------------
        | CEK STATUS
        |----------------------------------------------------------
        */

        if ($pengajuan->status !== 'diajukan') {

            return redirect()
                ->route(
                    'masyarakat.pengajuan.index'
                )
                ->with(
                    'error',
                    'Pengajuan yang sudah diproses tidak dapat dihapus.'
                );
        }


        /*
        |----------------------------------------------------------
        | HAPUS GAMBAR
        |----------------------------------------------------------
        */

        if ($pengajuan->gambar) {

            Storage::disk('public')
                ->delete(
                    $pengajuan->gambar
                );
        }


        /*
        |----------------------------------------------------------
        | HAPUS DATA
        |----------------------------------------------------------
        */

        $pengajuan->delete();


        /*
        |----------------------------------------------------------
        | KEMBALI KE INDEX
        |----------------------------------------------------------
        */

        return redirect()
            ->route(
                'masyarakat.pengajuan.index'
            )
            ->with(
                'success',
                'Pengajuan berhasil dihapus.'
            );
    }


    /**
     * ==========================================================
     * CEK KEPEMILIKAN PENGAJUAN
     * ==========================================================
     */
    private function authorizePengajuan(
        Pengajuan $pengajuan
    ): void {

        $masyarakatId =
            $this->getMasyarakatId();


        if (
            $pengajuan->id_masyarakat
            !== $masyarakatId
        ) {

            abort(
                403,
                'Anda tidak memiliki akses ke pengajuan ini.'
            );
        }
    }
}