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
        Schema::create('tanah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("polt-area_id");
            $table->foreign("polt-area_id")->references("id")->on("polt-area");
            $table->string("no_port", 255);
            $table->decimal('kedalaman_sample', 8, 2)->defaul(0);
            $table->decimal('berat_jenis_tanah', 8, 3)->defaul(0);
            $table->decimal('C_organic_tanah', 5, 2)->defaul(0);
            $table->decimal('carbongr', 8, 4);
            $table->decimal('carbonton', 10, 3);
            $table->decimal('carbonkg', 10, 2);
            $table->decimal('co2kg', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanah');
    }
};
