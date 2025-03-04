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
        Schema::create('plot', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("beabbs_id");
            $table->foreign("beabbs_id")->references("id")->on("beabbs")->onDelete('cascade');
            $table->string('nama_plot', 255)->nullable();
            $table->string("slug", 255);
            $table->string('type_plot', 255);
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plot');
    }
};
