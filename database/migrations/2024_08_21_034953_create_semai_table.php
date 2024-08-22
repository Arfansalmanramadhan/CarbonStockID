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
        Schema::create('semai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("polt_a_id");
            $table->foreign("polt_a_id")->references("id")->on("polt_a");
            $table->string("no_port", 255);
            $table->float('total_berat_basah', 10, 7)->defaul(0);
            $table->float('sample_berat_basah', 10, 7)->defaul(0);
            $table->float('total_berat_kering', 10, 7)->defaul(0);
            $table->float('sample_berat_kering', 10, 7)->defaul(0);
            $table->float('kandungan_karbon', 10, 7);
            $table->float('co2', 10, 7);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semai');
    }
};
