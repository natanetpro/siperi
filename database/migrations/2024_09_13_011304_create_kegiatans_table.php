<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemohon_id')->constrained()->onDelete('cascade');
            $table->enum('jenis_kegiatan', ['Riset', 'KKP', 'Prakerin']);
            $table->string('nama_kegiatan');
            $table->string('surat_permohonan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('approval_admin', ['Menunggu', 'Disetujui', 'Ditolak']);
            $table->longText('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};
