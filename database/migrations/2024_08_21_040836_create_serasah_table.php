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
        Schema::create('serasah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("polt-area_id");
            $table->foreign("polt-area_id")->references("id")->on("polt-area");
            $table->decimal('total_berat_basah', 8, 3)->defaul(0);
            $table->decimal('sample_berat_basah', 8, 3)->defaul(0);
            $table->decimal('sample_berat_kering', 8, 3)->defaul(0);
            $table->decimal('total_berat_kering', 8, 3)->defaul(0);
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
        Schema::dropIfExists('serasah');
    }
};
