<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLapdu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaduan_lapdu', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pegawai',70);
            $table->string('nomor_registrasi',30)->unique();
            $table->string('subjek',50);
            $table->text('isi_pengaduan');
            $table->string('file_pengaduan',120)->nullable();
            $table->text('keterangan')->nullable();
            $table->text('tim_penelaah')->nullable();
            $table->integer('id_status')->nullable();
            $table->integer('id_jenis')->nullable();
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
        Schema::dropIfExists('pengaduan_lapdu');
    }
}
