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
        Schema::create('zona', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("polt-area_id");
            $table->foreign("polt-area_id")->references("id")->on("polt-area")->onDelete('cascade');
            $table->string("zona", 250);
            $table->string("jenis_hutan", 250);
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('foto_area');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zona');
    }
};
