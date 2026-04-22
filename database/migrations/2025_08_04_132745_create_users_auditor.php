<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users_auditor', function (Blueprint $table) {
            $table->id();

            // Foreign key ke tabel spmipenilaianprodis
            $table->foreignId('spmi_penilaianprodis_id')
                ->constrained('spmi_penilaianprodis')
                ->onDelete('cascade');

            // Foreign key ke tabel users
            $table->foreignId('users_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->tinyInteger('status')->default(0);

            $table->text('keterangan')->nullable();

            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users_fakultas');
    }
};
