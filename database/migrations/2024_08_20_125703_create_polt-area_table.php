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
        Schema::create("polt-area", function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger("profil_id");
            $table->foreign("profil_id")->references("id")->on("profil");
            $table->string("nama_polt");
            $table->string("jenis");
            $table->string("slug",255);
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->float('ukuran_port', 10, 7);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("polt-area");
    }
};
