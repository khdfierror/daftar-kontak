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
        Schema::create('kontak_perusahaan', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('kontak_id')->index()->nullable();
            $table->foreignUlid('perusahaan_id')->index()->nullable();
            $table->tinyInteger('is_aktif')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontak_perusahaan');
    }
};
