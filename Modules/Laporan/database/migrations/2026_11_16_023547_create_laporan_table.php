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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            $table->foreignId('titik_sampahs_id')->constrained('titik_sampahs')->cascadeOnDelete();
            $table->text('volume_sampah');
            $table->text('status_kondisi')->default('menunggu'); 
            $table->text('deskripsi');                   
            $table->string('foto_bukti')->nullable();  
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }

};
