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
        Schema::create('data_kontak', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('nama_depan')->nullable();
            $table->string('nama_belakang')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->text('alamat')->nullable();
            $table->tinyInteger('is_aktif')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('data_grup', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('nama')->nullable();
            $table->tinyInteger('is_aktif')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('data_perusahaan', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('nama')->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('data_agenda', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('kontak_id')->index()->nullable();
            $table->string('nama')->nullable();
            $table->timestamp('tanggal')->nullable();
            $table->timestamp('waktu')->nullable();
            $table->text('lokasi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kontak');
        Schema::dropIfExists('data_grup');
        Schema::dropIfExists('data_perusahaan');
        Schema::dropIfExists('data_agenda');
    }
};
