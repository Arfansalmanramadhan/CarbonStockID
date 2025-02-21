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
        Schema::create('anggota_tim', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("registrasi_id");
            $table->foreign("registrasi_id")->references("id")->on("registrasi")->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger("tim_id");
            $table->foreign("tim_id")->references("id")->on("tim")->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_tim');
    }
};
