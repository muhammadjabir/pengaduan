<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableGratifikasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gratifikasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemberi',50);
            $table->string('pekerjaan',50);
            $table->string('nohp',50);
            $table->date('tgl_terima');
            $table->text('alasan');
            $table->tinyInteger('jrnid');
            $table->text('alamat');
            $table->string('hubungan',80);
            $table->text('lokasi_diterima');
            $table->text('kronologi');
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
        Schema::dropIfExists('gratifikasi');
    }
}
