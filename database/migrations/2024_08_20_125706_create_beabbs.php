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
        Schema::create('beabbs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("hamparan_id");
            $table->foreign("hamparan_id")->references("id")->on("hamparan")->onDelete('cascade');
            $table->string('lokasi', 255)->nullable();
            $table->string("slug", 255);
            $table->string('zona', 255)->nullable();
            $table->decimal('hamparan',255)->nullable();
            $table->decimal('jenis_hutan',255)->nullable();
            $table->date('tanggal')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beabbs');
    }
};
