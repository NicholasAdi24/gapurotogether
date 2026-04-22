<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users_fakultas', function (Blueprint $table) {
            $table->id();

            // Foreign key ke tabel users
            $table->foreignId('users_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Foreign key ke tabel fakultas
            $table->foreignId('fakultas_id')
                ->constrained('fakultass')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users_fakultas');
    }
};
