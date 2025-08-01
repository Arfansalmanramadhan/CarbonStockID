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
        Schema::create('galeri', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("registrasi_id");
            $table->foreign("registrasi_id")->references("id")->on("registrasi")->onDelete('cascade')->onUpdate('cascade');
            $table->date('tanggal',255)->nullable();
            $table->string("nama_judul", 255)->nullable();
            $table->string("foto", 255)->nullable();
            $table->string("video", 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeri');
    }
};
