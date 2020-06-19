<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableWbs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wbs', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_registrasi',30)->unique();
            $table->string('subjek');
            $table->string('isi_pengaduan');
            $table->string('file_pengaduan')->nullable();
            $table->integer('id_warga');
            $table->text('jawaban')->nullable();
            $table->integer('id_admin')->nullable();
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
        Schema::dropIfExists('wbs');
    }
}
