<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableWarga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warga', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('ktp')->unique();
            $table->text('alamat')->nullable();
            $table->string('email');
            $table->string('nohp');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warga');
    }
}
