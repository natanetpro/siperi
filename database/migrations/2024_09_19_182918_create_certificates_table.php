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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemimpin');
            $table->string('jabatan_pemimpin');
            $table->string('nip_pemimpin');
            // $table->enum('jenis_sertifikat', ['Riset', 'PPK', 'Prakerin']);
            // $table->string('ttd_pemimpin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
