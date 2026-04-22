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
        Schema::create('spmi_rtl', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('spmi_penilaianindikatorscalc_id');
            $table->text('program_kerja');
            $table->integer('target')->nullable();
            $table->integer('capaian')->nullable();
            $table->text('deskripsi_risiko')->nullable();
            $table->text('pengendalian')->nullable();
            $table->text('akar_masalah')->nullable();
            $table->string('kategori_risiko', 50)->nullable();
            $table->integer('probability')->nullable();
            $table->integer('severity')->nullable();
            $table->text('rtl')->nullable();
            $table->string('anggaran', 128)->nullable();
            $table->string('selesai', 128)->nullable();
            $table->string('pic', 128)->nullable();
            $table->string('persetujuan', 128)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->foreign('spmi_penilaianindikatorscalc_id')->references('id')->on('spmi_penilaianindikatorscalc');
            $table->timestamps();
        });

        Schema::create('spmi_rtlprob', function (Blueprint $table) {
            $table->id();
            $table->string('kategori', 128);
            $table->tinyInteger('nilai');
            $table->text('keterangan')->nullable();
            $table->tinyInteger('status')->default(1);
        });

        Schema::create('spmi_rtlsever', function (Blueprint $table) {
            $table->id();
            $table->string('kategori', 128);
            $table->tinyInteger('nilai');
            $table->text('keterangan')->nullable();
            $table->tinyInteger('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spmi_rtlsever');
        Schema::dropIfExists('spmi_rtlprob');
        Schema::dropIfExists('spmi_rtl');
    }
};
