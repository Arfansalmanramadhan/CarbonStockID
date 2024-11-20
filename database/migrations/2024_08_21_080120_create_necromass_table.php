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
        Schema::create('necromass', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("polt-area_id");
            $table->foreign("polt-area_id")->references("id")->on("polt-area");
            $table->decimal('diameter_pangkal', 8, 2)->defaul(0);
            $table->decimal('diameter_ujung', 8, 2)->defaul(0);
            $table->decimal('panjang', 8, 2)->defaul(0);
            $table->decimal('volume', 10, 2);
            $table->decimal('berat_jenis_kayu', 10, 2);
            $table->decimal('biomasa', 10, 2);
            $table->decimal('carbon', 10, 2);
            $table->decimal('co2', 10, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('necromass');
    }
};
