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
            $table->unsignedBigInteger("subplot_id");
            $table->foreign("subplot_id")->references("id")->on("subplot")->onDelete('cascade');
            $table->decimal('diameter_pangkal', 8, 2)->default(0);
            $table->decimal('diameter_ujung', 8, 2)->default(0);
            $table->decimal('panjang', 8, 2)->default(0);
            $table->decimal('volume', 10, 2)->default(0);
            $table->decimal('berat_jenis_kayu', 10, 2)->default(0);
            $table->decimal('biomasa', 10, 2)->default(0);
            $table->decimal('carbon', 10, 2)->default(0);
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
        Schema::dropIfExists('necromass');
    }
};
