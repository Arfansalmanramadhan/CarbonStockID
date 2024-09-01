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
        Schema::create('login', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("registrasi_id");
            $table->foreign("registrasi_id")->references("id")->on("registrasi")->onDelete('cascade')->onUpdate('cascade');
            $table->string("slug", 255);
            $table->string('email')->unique();
            $table->integer('no_hp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login');
    }
};
