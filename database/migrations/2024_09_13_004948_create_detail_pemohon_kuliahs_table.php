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
        Schema::create('detail_pemohon_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemohon_id')->constrained()->onDelete('cascade');
            $table->string('nim', 20);
            $table->string('universitas');
            $table->string('fakultas');
            $table->string('prodi');
            $table->integer('semester');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pemohon_kuliahs');
    }
};
