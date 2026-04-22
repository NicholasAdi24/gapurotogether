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
         * Run table users
         * users perlu tambah field
         */
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image',128)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->dateTime('last_login')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        /**
         * Run table roles
         * roles tidak dapat dihapus
         */
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->timestamps();
        });

        /**
         * Run table users roles
         * 1 users memungkinkan beberapa roles
         * jika users hanya 1 roles langsung login jika tidak pilih roles dahulu
         */
        Schema::create('users_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('roles_id');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('roles_id')->references('id')->on('roles');
        });

        /**
         * Run table menus
         * menu memiliki fuction untuk membedakan level rolesnya
         *
         */
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('icon');
            $table->string('permalink');
            $table->string('fuction');
            $table->integer('parent_id');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });

        /**
         * Run table rolesmenus
         * 1 roles punya banyak menu
         *
         */
        Schema::create('menus_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menus_id');
            $table->unsignedBigInteger('roles_id');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->foreign('menus_id')->references('id')->on('menus');
            $table->foreign('roles_id')->references('id')->on('roles');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('menus_roles');
        Schema::dropIfExists('menus');
        Schema::dropIfExists('users_roles');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('users');

    }
};
