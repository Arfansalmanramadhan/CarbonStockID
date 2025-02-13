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
        Schema::create('registrasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id');
            $table->foreign('role_id')->on('roles')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama')->nullable();
            $table->string('username');
            $table->string("slug", 255);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('foto')->nullable();
            $table->string('nip')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('nik')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('foto_tandatangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrasi');
    }
};
