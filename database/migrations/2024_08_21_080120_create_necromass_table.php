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
            $table->unsignedBigInteger("polt_a_id");
            $table->foreign("polt_a_id")->references("id")->on("polt_a");
            $table->string("no_port", 255);
            $table->float('diameter_pangkal', 10, 7)->defaul(0);
            $table->float('diameter_ujung', 10, 7)->defaul(0);
            $table->float('panjang', 10, 7)->defaul(0);
            $table->float('volume', 10, 7);
            $table->float('berat_jenis_kayu', 10, 7);
            $table->float('biomasa', 10, 7);
            $table->float('carbon', 10, 7);
            $table->float('co2', 10, 7);
            $table->timestamps();
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
