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
        Schema::create('serasah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("subplot_id");
            $table->foreign("subplot_id")->references("id")->on("subplot")->onDelete('cascade');
            $table->decimal('total_berat_basah', 8, 2)->default(0);
            $table->decimal('sample_berat_basah', 8, 2)->default(0);
            $table->decimal('sample_berat_kering', 8, 2)->default(0);
            $table->decimal('total_berat_kering', 8, 2)->default(0);
            $table->decimal('kandungan_karbon', 10, 2)->default(0);
            $table->decimal('co2', 10, 2)->default(0);
            $table->date('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serasah');
    }
};
