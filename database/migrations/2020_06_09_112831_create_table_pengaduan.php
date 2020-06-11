<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePengaduan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->string('subjek');
            $table->string('slug');
            $table->string('isi_pengaduan');
            $table->string('file_pengaduan');
            $table->string('id_kategori');
            $table->boolean('status_tampil');
            $table->boolean('id_warga');
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
        Schema::dropIfExists('pengaduan');
    }
}
