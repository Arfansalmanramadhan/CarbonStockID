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
        Schema::create('polt_a', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("polt-area_id");
            $table->foreign("polt-area_id")->references("id")->on("polt-area");
            $table->timestamps();
        });
        Schema::create('polt_b', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("polt-area_id");
            $table->foreign("polt-area_id")->references("id")->on("polt-area");
            $table->timestamps();
        });
        Schema::create('polt_c', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("polt-area_id");
            $table->foreign("polt-area_id")->references("id")->on("polt-area");
            $table->timestamps();
        });
        Schema::create('polt_d', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("polt-area_id");
            $table->foreign("polt-area_id")->references("id")->on("polt-area");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polt_a');
        Schema::dropIfExists('polt_b');
        Schema::dropIfExists('polt_c');
        Schema::dropIfExists('polt_d');
    }
};
