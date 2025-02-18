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
            $table->unsignedBigInteger("zona_id");
            $table->foreign("zona_id")->references("id")->on("zona");
            $table->decimal('kedalaman_sample', 8, 2)->default(0);
            $table->decimal('berat_jenis_tanah', 8, 2)->default(0);
            $table->decimal('C_organic_tanah', 5, 2)->default(0);
            $table->decimal('carbongr', 8, 4)->default(0);
            $table->decimal('carbonton', 10, 2)->default(0);
            $table->decimal('carbonkg', 10, 2)->default(0);
            $table->decimal('co2kg', 10, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
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
