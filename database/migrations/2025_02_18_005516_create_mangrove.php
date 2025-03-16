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
        Schema::create('mangrove', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("subplot_id");
            $table->foreign("subplot_id")->references("id")->on("subplot")->onDelete('cascade');
            $table->decimal('no_pohon', 8, 2)->default(0);
            $table->string('jenis_tanaman', 255);
            $table->string('diameter', 10)->default(0);
            $table->string('jumlah_tanaman', 8, 2)->default(0);
            $table->decimal('biomasa', 10, 2)->default(0);
            $table->decimal('kandungan_karbon', 10, 2)->default(0);
            $table->decimal('karbondioksida', 10, 2)->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mangrove');
    }
};
