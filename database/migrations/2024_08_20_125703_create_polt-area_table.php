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
        Schema::create("polt_area", function (Blueprint $table) {
            $table->id();
            $table->string("daerah")->nullable();
            $table->string("slug", 255);
            $table->string("jenis_hutan", 250);
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->decimal('luas_lokasi',10,2)->default(0);
            $table->string('periode_pengamatan');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger("periode_id");
            $table->foreign("periode_id")->references("id")->on("periode")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("polt_area");
    }
};
