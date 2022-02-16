<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInitialsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('level');
            $table->json('refs')->nullable();
        });

        Schema::create('profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->json('refs')->nullable();
            $table->timestamps();
        });

        Schema::create('configs', function (Blueprint $table) {
            $table->string('title')->unique();
            $table->json('refs')->nullable();
        });

        Schema::create('klien', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('nik')->unique()->nullable();
            $table->json('refs')->nullable();
            $table->timestamps();
        });

        Schema::create('pelayanan', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->json('refs')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('pelayanan_jadwal', function (Blueprint $table) {
            // $table->uuid('id')->primary();
            $table->id();
            $table->unsignedBigInteger('pelayanan_id');
            $table->unsignedBigInteger('klien_id')->nullable();
            $table->unsignedBigInteger('pelaksana_id')->nullable();
            $table->date('tanggal');
            $table->json('refs')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index([
                'pelayanan_id',
                'klien_id',
                'pelaksana_id',
            ]);
        });

        Schema::create('pertanyaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('pertanyaan');
            $table->json('refs')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('kuesioner', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pertanyaan_id');
            $table->unsignedBigInteger('pelayanan_id');
            $table->unsignedInteger('nomor');
            $table->boolean('hide')->default(false);
            $table->json('refs')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('survei', function (Blueprint $table) {
            // $table->char('jadwal_id', 36);
            $table->unsignedBigInteger('jadwal_id');
            $table->unsignedBigInteger('kuesioner_id');
            $table->double('skor', 3, 2);
            $table->index([
                'jadwal_id',
                'kuesioner_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('profiles');
        Schema::dropIfExists('configs');
        Schema::dropIfExists('klien');
        Schema::dropIfExists('pelayanan');
        Schema::dropIfExists('pelayanan_jadwal');
        Schema::dropIfExists('pertanyaan');
        Schema::dropIfExists('kuesioner');
        Schema::dropIfExists('survei');
    }
}
