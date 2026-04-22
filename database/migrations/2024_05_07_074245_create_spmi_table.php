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
         * Run table spmi periode penilaian
         *
         *
         */
        Schema::create('spmi_periodes', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('tahun');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->text('catatan');
            $table->text('keterangan');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });


        /**
         * Run table spmi elemen = elemen
         * Menyesuaikan APS BAN PT bukan SNDIKTI
         *
         */
        Schema::create('spmi_elemens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lembagas_id');
            $table->unsignedBigInteger('spmi_periodes_id');
            $table->string('kode', 16);
            $table->integer('tahun');
            $table->string('kriteria', 128);
            $table->text('keterangan');
            $table->tinyInteger('status')->default(1);
            $table->foreign('lembagas_id')->references('id')->on('lembagas');
            $table->timestamps();
        });

        /**
         * Run table spmi Indikator
         * Indikator dari masing masing elemen
         * Tipe : 1 Kinerja Utama Univ
         *      : 2 Kinerja Tambahan Univ
         *      : 3 Kinerja Tambahan Fakultas / Sekolah
         */
        Schema::create('spmi_indikators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('urutan');
            $table->unsignedBigInteger('spmi_elemens_id');
            $table->string('kode', 16);
            $table->text('indikator', 128);
            $table->string('spmi_tipe_id', 32);
            $table->text('keterangan');
            $table->text('asal');
            $table->text('rumus');
            $table->unsignedBigInteger('stratas_id');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->foreign('spmi_elemens_id')->references('id')->on('spmi_elemens');
            $table->foreign('stratas_id')->references('id')->on('stratas');
        });

        /**
         * Run table spmi bobot
         * bobot dari masing masing starta
         * Tipe : 1 Kinerja Utama Univ
         *      : 2 Kinerja Tambahan Univ
         *      : 3 Kinerja Tambahan Fakultas / Sekolah
         */
        Schema::create('spmi_bobots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('spmi_indikators_id');
            $table->decimal('bobots1', 5, 2)->nullable();
            $table->decimal('bobotd4', 5, 2)->nullable();
            $table->decimal('bobots2', 5, 2)->nullable();
            $table->decimal('bobots3', 5, 2)->nullable();
            $table->decimal('skor_min', 5, 2)->nullable();
            $table->text('syarat_perlu', 128);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->foreign('spmi_indikators_id')->references('id')->on('spmi_indikators');

        });

        /**
         * Run table spmi standar
         * Standar dari masing masing kriteria
         *
         */
        Schema::create('spmi_indikatorsubs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('spmi_indikators_id');
            $table->string('kode', 16);
            $table->text('indikatorsub', 128);
            $table->text('keterangan');
            $table->text('asal');
            $table->text('rumus');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('calculate')->default(1);
            $table->timestamps();
            $table->foreign('spmi_indikators_id')->references('id')->on('spmi_indikators');
        });

        /**
         * Run table spmi Indikator penilaian
         *
         */
        Schema::create('spmi_indikatorkualitatifs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('spmi_indikators_id')->nullable();
            $table->unsignedBigInteger('spmi_indikatorsubs_id')->nullable();
            $table->text('keterangan');
            $table->string('nilai', 10);
            $table->timestamps();
            $table->foreign('spmi_indikators_id')->references('id')->on('spmi_indikators');
            $table->foreign('spmi_indikatorsubs_id')->references('id')->on('spmi_indikatorsubs');
        });

        /**
         * Run table spmi Indikator Komponen
         *
         */
        Schema::create('spmi_indikatorkomponens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('spmi_indikators_id')->nullable();
            $table->unsignedBigInteger('spmi_indikatorsubs_id')->nullable();
            $table->text('komponen', 64);
            $table->text('keterangan');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->foreign('spmi_indikators_id')->references('id')->on('spmi_indikators');
            $table->foreign('spmi_indikatorsubs_id')->references('id')->on('spmi_indikatorsubs');
        });


        /**
         * Run table spmi Kategori Jenis Temuan
         *
         */
        Schema::create('spmi_kategorijenistemuans', function (Blueprint $table) {
            $table->id();
            $table->text('kategori', 64);
            $table->text('kode', 16);
            $table->text('keterangan');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });

        /**
         * Run table penilaian prodi
         * penilaian masing masing rata rata prodi
         *
         */
        Schema::create('spmi_penilaianprodis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('programstudis_id');
            $table->unsignedBigInteger('spmi_periodes_id');
            $table->unsignedBigInteger('lembagas_id');
            $table->integer('tahun');
            $table->string('nilai_prodi_final');
            $table->string('nilai_auditor_final');
            $table->string('skor_final');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->string('auditor_id')->nullable();
            $table->foreign('programstudis_id')->references('id')->on('programstudis');
            $table->foreign('spmi_periodes_id')->references('id')->on('spmi_periodes');
            $table->foreign('lembagas_id')->references('id')->on('lembagas');
        });

        /**
         * Run table penilaian elemen
         * penilaian masing masing elemen dari indikator
         * nilai prodi : diisi prodi
         * nilai auditor : diisi auditor
         * validasi : status
         * catatan_prodi : keterangan prodi
         * link / berkas : link gdrive / upload
         */
        Schema::create('spmi_penilaianindikators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('spmi_penilaianprodis_id');
            $table->unsignedBigInteger('spmi_indikators_id')->nullable();
            $table->unsignedBigInteger('spmi_indikatorsubs_id')->nullable();
            $table->unsignedBigInteger('spmi_kategorijenistemuans_id')->nullable();
            $table->decimal('nilai_prodi', 5, 2)->nullable();
            $table->decimal('nilai_auditor', 5, 2)->nullable();
            $table->decimal('skor_bobot', 5, 2)->nullable();
            $table->text('berkas')->nullable();
            $table->text('link')->nullable();
            $table->text('catatan_prodi')->nullable();
            $table->text('catatan_auditor')->nullable();
            $table->text('apresiasi_pelampauan')->nullable();
            $table->text('deskripsi_temuan')->nullable();
            $table->text('dampak_temuan')->nullable();
            $table->text('akar_masalah_temuan')->nullable();
            $table->text('rekomendasi_temuan')->nullable();
            $table->text('feedback_prodi')->nullable();
            $table->text('tindak_lanjut')->nullable();
            $table->tinyInteger('status')->default(1)->nullable();
            $table->tinyInteger('perhatian')->default(0)->nullable();

            $table->timestamps();
            $table->foreign('spmi_penilaianprodis_id')->references('id')->on('spmi_penilaianprodis');
            $table->foreign('spmi_indikators_id')->references('id')->on('spmi_indikators');
            $table->foreign('spmi_kategorijenistemuans_id')->references('id')->on('spmi_kategorijenistemuans');
            $table->foreign('spmi_indikatorsubs_id')->references('id')->on('spmi_indikatorsubs');
        });

        /**
         * Run table penilaian komponen
         * penilaian masing masing standar dari kriteria
         *
         */
        Schema::create('spmi_pindikatorkomponens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('spmi_penilaianindikators_id');
            $table->unsignedBigInteger('spmi_indikatorkomponens_id');
            $table->string('nilai_prodi')->nullable();;
            $table->string('nilai_auditor')->nullable();;
            $table->timestamps();
            $table->foreign('spmi_penilaianindikators_id')->references('id')->on('spmi_penilaianindikators');
            $table->foreign('spmi_indikatorkomponens_id')->references('id')->on('spmi_indikatorkomponens');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spmi_pindikatorkomponens');
        // Schema::dropIfExists('spmi_penilaianindikatorsubs');
        Schema::dropIfExists('spmi_penilaianindikators');
        Schema::dropIfExists('spmi_penilaianprodis');
        Schema::dropIfExists('spmi_indikatorpenilaians');
        Schema::dropIfExists('spmi_indikatorkomponens');
        Schema::dropIfExists('spmi_kategorijenistemuans');
        Schema::dropIfExists('spmi_indikatorkualitatifs');
        Schema::dropIfExists('spmi_indikatorsubs');
        Schema::dropIfExists('spmi_bobots');
        Schema::dropIfExists('spmi_indikators');
        Schema::dropIfExists('spmi_elemens');
        Schema::dropIfExists('spmi_periodes');
    }
};
