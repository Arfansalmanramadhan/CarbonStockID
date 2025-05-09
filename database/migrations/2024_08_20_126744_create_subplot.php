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
            $table->foreign("plot_id")->references("id")->on("plot")->onDelete('cascade');
            $table->string("nama_suplort", 255)->nullable();
            $table->string("slug", 255)->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->date('deleted_at')->nullable();
            $table->timestamps();
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
