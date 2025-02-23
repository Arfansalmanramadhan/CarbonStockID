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
        Schema::create('periode', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("anggota_tim_id");
            $table->foreign("anggota_tim_id")->references("id")->on("anggota_tim")->onDelete('cascade')->onUpdate('cascade');
            $table->string("nama_periode",255);
            $table->date("tanggal_mulai");
            $table->date("tanggal_berakhir");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periode');
    }
};
