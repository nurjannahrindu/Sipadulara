<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penanganan', function (Blueprint $table) {
            $table->id('id_penanganan');

            $table->foreignId('id_admin')
                ->constrained('admin', 'id_admin')
                ->cascadeOnDelete();

            $table->foreignId('id_pengajuan')
                ->constrained('pengajuan', 'id_pengajuan')
                ->cascadeOnDelete();

            $table->enum('status', [
                'diproses',
                'ditangani',
                'selesai',
                'ditolak'
            ])->default('diproses');

            $table->date('tanggal_penanganan');
            $table->text('keterangan')->nullable();
            $table->string('gambar')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penanganan');
    }
};