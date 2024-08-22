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
        Schema::create('summary_karbon', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("tanah_id");
            $table->foreign("tanah_id")->references("id")->on("tanah");
            $table->unsignedBigInteger("necromass_id");
            $table->foreign("necromass_id")->references("id")->on("necromass");
            $table->unsignedBigInteger("serasah_id");
            $table->foreign("serasah_id")->references("id")->on("serasah");
            $table->unsignedBigInteger("tumbuhan_bawah_id");
            $table->foreign("tumbuhan_bawah_id")->references("id")->on("tumbuhan_bawah");
            $table->unsignedBigInteger("semai_id");
            $table->foreign("semai_id")->references("id")->on("semai");
            $table->unsignedBigInteger("pancang_id");
            $table->foreign("pancang_id")->references("id")->on("pancang");
            $table->unsignedBigInteger("tiang_id");
            $table->foreign("tiang_id")->references("id")->on("tiang");
            $table->unsignedBigInteger("pohon_id");
            $table->foreign("pohon_id")->references("id")->on("pohon");
            $table->float('total_karbon', 10, 7);
            $table->timestamps();
        });
        Schema::create('summary_co2', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("akar_id");
            $table->foreign("akar_id")->references("id")->on("akar");
            $table->unsignedBigInteger("tanah_id");
            $table->foreign("tanah_id")->references("id")->on("tanah");
            $table->unsignedBigInteger("necromass_id");
            $table->foreign("necromass_id")->references("id")->on("necromass");
            $table->unsignedBigInteger("serasah_id");
            $table->foreign("serasah_id")->references("id")->on("serasah");
            $table->unsignedBigInteger("tumbuhan_bawah_id");
            $table->foreign("tumbuhan_bawah_id")->references("id")->on("tumbuhan_bawah");
            $table->unsignedBigInteger("semai_id");
            $table->foreign("semai_id")->references("id")->on("semai");
            $table->unsignedBigInteger("pancang_id");
            $table->foreign("pancang_id")->references("id")->on("pancang");
            $table->unsignedBigInteger("tiang_id");
            $table->foreign("tiang_id")->references("id")->on("tiang");
            $table->unsignedBigInteger("pohon_id");
            $table->foreign("pohon_id")->references("id")->on("pohon");
            $table->float('total_co2', 10, 7);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('summary_karbon');
        Schema::dropIfExists('summary_co2');
    }
};
