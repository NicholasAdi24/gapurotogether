<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('spmi_penilaianindikatorscalc', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('spmi_penilaianprodis_id');
            $table->unsignedBigInteger('spmi_indikators_id');

            $table->float('nilai_prodi')->nullable();
            $table->float('nilai_auditor')->nullable();
            $table->tinyInteger('status')->default(0);

            $table->timestamps();

            // Foreign Key Manual
            $table->foreign('spmi_penilaianprodis_id', 'fk_penilaiancalculate_penilaianprodi')
                ->references('id')->on('spmi_penilaianprodis')
                ->onDelete('cascade');

            $table->foreign('spmi_indikators_id', 'fk_penilaiancalculate_indikator')
                ->references('id')->on('spmi_indikators')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spmi_penilaianindikatorscalculate');
    }
};
