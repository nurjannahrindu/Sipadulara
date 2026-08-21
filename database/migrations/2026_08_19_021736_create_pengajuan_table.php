<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id('id_pengajuan');

            $table->foreignId('id_masyarakat')
                ->constrained('masyarakat', 'id_masyarakat')
                ->cascadeOnDelete();

            $table->foreignId('id_kategori')
                ->constrained('kategori', 'id_kategori')
                ->cascadeOnDelete();

            $table->string('judul');
            $table->text('keterangan');
            $table->string('lokasi');
            $table->string('gambar')->nullable();
            $table->date('tanggal');
            $table->enum('status', [
                'diajukan',
                'diproses',
                'ditangani',
                'selesai',
                'ditolak'
            ])->default('diajukan');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};