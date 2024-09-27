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
        Schema::create('masukan_sarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_kegiatan_id')->constrained('user_kegiatans')->onDelete('cascade');
            $table->text('masukan_saran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masukan_sarans');
    }
};
