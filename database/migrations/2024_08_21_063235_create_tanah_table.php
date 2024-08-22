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
            $table->unsignedBigInteger("polt_a_id");
            $table->foreign("polt_a_id")->references("id")->on("polt_a");
            $table->string("no_port", 255);
            $table->float('kedalaman_sample', 10, 7)->defaul(0);
            $table->float('berat_jenis_tanah', 10, 7)->defaul(0);
            $table->float('C_organic_tanah', 10, 7)->defaul(0);
            $table->float('carbongr', 10, 7);
            $table->float('carbonton', 10, 7);
            $table->float('carbonkg', 10, 7);
            $table->float('co2kg', 10, 7);
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
