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
        Schema::create('detail_pemohon_sekolahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemohon_id')->constrained()->onDelete('cascade');
            $table->string('nis', 20);
            $table->string('sekolah');
            $table->integer('kelas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pemohon_sekolahs');
    }
};
