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
         * Run table spmi elemen = elemen
         * Menyesuaikan APS BAN PT bukan SNDIKTI
         *
         */
        Schema::create('spme_akreditasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('programstudis_id')->nullable();
            $table->string('no_sk', 255);
            $table->integer('tahun');
            $table->date('masa_mulai');
            $table->date('masa_akhir');
            $table->string('akreditasi',64);
            $table->text('skor',16)->nullable();
            $table->tinyInteger('type');
            $table->string('berkas', 128)->nullable();
            $table->string('lembaga', 128);
            $table->text('keterangan')->nullable();
            $table->string('updateby',128);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->foreign('programstudis_id')->references('id')->on('programstudis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spme_akreditasis');
    }
};
