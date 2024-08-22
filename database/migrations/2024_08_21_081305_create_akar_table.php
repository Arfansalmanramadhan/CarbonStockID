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
        Schema::create('akar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("polt_a_id");
            $table->foreign("polt_a_id")->references("id")->on("polt_a");
            $table->unsignedBigInteger("pancang_id");
            $table->foreign("pancang_id")->references("id")->on("pancang");
            $table->unsignedBigInteger("tiang_id");
            $table->foreign("tiang_id")->references("id")->on("tiang");
            $table->unsignedBigInteger("pohon_id");
            $table->foreign("pohon_id")->references("id")->on("pohon");
            $table->float('total_berat_masa', 10, 7);
            $table->float('berat_biomasa_akar', 10, 7);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akar');
    }
};
