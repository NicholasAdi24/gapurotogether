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
        /**
         * Run table fakultas
         * Fakultas parent prodi
         */
        Schema::create('fakultass', function (Blueprint $table) {
            $table->id();
            $table->string('nama_fakultas', 50);
        });

        /**
         * Run table departemen
         * Departemen tidak dapat dihapus
         */
        Schema::create('departemens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fakultass_id');
            $table->string('nama_departemen', 50);
            $table->foreign('fakultass_id')->references('id')->on('fakultass');
        });

        /**
         * Run table strata
         * Strata tidak dapat dihapus
         */
        Schema::create('stratas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_strata', 50);
        });

        /**
         * Run table programstudis
         * Program Studi tidak semua punya departemen (Non Departemen)
         */
        Schema::create('programstudis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fakultass_id');
            $table->unsignedBigInteger('departemens_id')->nullable();
            $table->unsignedBigInteger('stratas_id');
            $table->string('kode_prodi', 16);
            $table->string('nama_prodi', 128);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->foreign('fakultass_id')->references('id')->on('fakultass');
            $table->foreign('departemens_id')->references('id')->on('departemens');
            $table->foreign('stratas_id')->references('id')->on('stratas');
        });

        /**
         * Run table user programstudis
         *
         */
        Schema::create('users_programstudis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('programstudis_id');
            $table->unsignedBigInteger('users_id');
            $table->tinyInteger('status')->default(1);
            $table->integer('tahun')->nullable();
            $table->timestamps();
            $table->foreign('programstudis_id')->references('id')->on('programstudis');
            $table->foreign('users_id')->references('id')->on('users');
        });

        /**
         * Run table spmi periode penilaian
         *
         *
         */
        Schema::create('lembagas', function (Blueprint $table) {
            $table->id();
            $table->string('nama',64);
            $table->string('kepanjangan',128);
            $table->string('ruanglingkup', 255);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lembagas');
        Schema::dropIfExists('users_programstudis');
        Schema::dropIfExists('programstudis');
        Schema::dropIfExists('stratas');
        Schema::dropIfExists('departemens');
        Schema::dropIfExists('fakultass');
    }
};
