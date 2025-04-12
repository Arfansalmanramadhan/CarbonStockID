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
        Schema::create('pancang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("subplot_id");
            $table->foreign("subplot_id")->references("id")->on("subplot")->onDelete('cascade');
            $table->decimal('no_pohon', 8, 2)->default(0);
            $table->decimal('keliling', 8, 2)->default(0);
            $table->decimal('diameter', 8, 2)->default(0);
            $table->string("nama_lokal",255);
            $table->string("nama_ilmiah",255);
            $table->decimal('kerapatan_jenis_kayu', 8, 2)->default(0);
            $table->decimal('bio_di_atas_tanah', 10, 2)->default(0);
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
        Schema::dropIfExists('pancang');
    }
};
