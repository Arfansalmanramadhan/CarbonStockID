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
        Schema::create('tumbuhan_bawah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("zona_id");
            $table->foreign("zona_id")->references("id")->on("zona");
            $table->decimal('total_berat_basah', 8, 2)->default(0);
            $table->decimal('sample_berat_basah', 8, 2)->default(0);
            $table->decimal('sample_berat_kering', 8, 2)->default(0);
            $table->decimal('total_berat_kering', 8, 2)->default(0);
            $table->decimal('kandungan_karbon', 10, 2)->default(0);
            $table->decimal('co2', 10, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tumbuhan_bawah');
    }
};
