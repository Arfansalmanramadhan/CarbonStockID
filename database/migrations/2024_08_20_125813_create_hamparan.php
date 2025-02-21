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
        Schema::create('hamparan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("zona_id");
            $table->foreign("zona_id")->references("id")->on("zona")->onDelete('cascade');
            $table->string("nama")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hamparan');
    }
};
