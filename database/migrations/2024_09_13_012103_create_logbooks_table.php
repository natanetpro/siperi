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
        Schema::create('logbooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_kegiatan_id')->constrained()->onDelete('cascade');
            $table->date('tanggal');
            $table->longText('aktivitas');
            $table->string('dokumentasi')->nullable();
            $table->enum('approval_pembimbing', ['Menunggu', 'Disetujui', 'Ditolak'])->default('Menunggu');
            $table->longText('catatan_pembimbing')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logbooks');
    }
};
