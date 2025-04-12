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
        Schema::create('periode', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("tim_id");
            $table->foreign("tim_id")->references("id")->on("tim")->onDelete('cascade')->nullable()->change();
            $table->string("nama_periode",255)->nullable();
            $table->date("tanggal_mulai");
            $table->date("tanggal_berakhir");
            $table->date('deleted_at')->nullable();
            $table->timestamps();
            $table->boolean('visible')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periode');
    }
};
