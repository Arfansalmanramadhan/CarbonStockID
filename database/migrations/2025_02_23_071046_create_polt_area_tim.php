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
        Schema::create('polt_area_tim', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("tim_id");
            $table->foreign("tim_id")->references("id")->on("tim")->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger("polt_area_id");
            $table->foreign("polt_area_id")->references("id")->on("polt_area")->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polt_area_tim');
    }
};
