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
        Schema::table('polt-area', function (Blueprint $table) {
            $table->softDeletes(); // menambahkan kolom deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('polt-area', function (Blueprint $table) {
            $table->dropSoftDeletes(); // menghapus kolom deleted_at
        });
    }
};
