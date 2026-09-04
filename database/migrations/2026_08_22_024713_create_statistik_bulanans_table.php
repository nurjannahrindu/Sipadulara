<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('statistik_bulanans', function (Blueprint $table) {
            $table->id();

            $table->unsignedSmallInteger('tahun');
            $table->unsignedTinyInteger('bulan');

            $table->unsignedInteger('total_pengajuan')->default(0);
            $table->unsignedInteger('diajukan')->default(0);
            $table->unsignedInteger('diproses')->default(0);
            $table->unsignedInteger('ditangani')->default(0);
            $table->unsignedInteger('selesai')->default(0);
            $table->unsignedInteger('ditolak')->default(0);

            $table->decimal('persen_diajukan', 5, 2)->default(0);
            $table->decimal('persen_diproses', 5, 2)->default(0);
            $table->decimal('persen_ditangani', 5, 2)->default(0);
            $table->decimal('persen_selesai', 5, 2)->default(0);
            $table->decimal('persen_ditolak', 5, 2)->default(0);

            $table->timestamps();

            $table->unique(['tahun', 'bulan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statistik_bulanans');
    }
};