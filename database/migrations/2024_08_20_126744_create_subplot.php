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
        Schema::create('subplot', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("plot_id");
            $table->foreign("plot_id")->references("id")->on("plot")->onDelete('cascade')->onUpdate('cascade');
            $table->string("nama_suplort", 255)->nullable();
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
        Schema::dropIfExists('subplot');
    }
};
