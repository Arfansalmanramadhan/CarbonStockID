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
        Schema::create('pohon', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("polt-area_id");
            $table->foreign("polt-area_id")->references("id")->on("polt-area");
            $table->decimal('keliling', 8, 2)->defaul(0);
            $table->decimal('diameter', 8, 2)->defaul(0);
            $table->string("nama_lokal", 255);
            $table->string("nama_ilmiah", 255);
            $table->decimal('kerapatan_jenis_kayu', 8, 4)->defaul(0);
            $table->decimal('bio_di_atas_tanah', 10, 2);
            $table->decimal('kandungan_karbon', 10, 2);
            $table->decimal('co2', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pohon');
    }
};
