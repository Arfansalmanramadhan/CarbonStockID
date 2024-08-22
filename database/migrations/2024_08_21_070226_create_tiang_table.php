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
        Schema::create('tiang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("polt_c_id");
            $table->foreign("polt_c_id")->references("id")->on("polt_c");
            $table->string("no_port", 255);
            $table->string("no_pohon", 255);
            $table->float('keliling', 10, 7)->defaul(0);
            $table->float('diameter', 10, 7)->defaul(0);
            $table->string("nama-lokal",255);
            $table->string("nama-ilmiah",255);
            $table->float('kerapatan_jenis_kayu', 10, 7)->defaul(0);
            $table->float('bio_di_atas_tabah', 10, 7);
            $table->float('kandungan_karbon', 10, 7);
            $table->float('CO2', 10, 7);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiang');
    }
};