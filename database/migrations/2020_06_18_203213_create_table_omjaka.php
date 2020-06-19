<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOmjaka extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('omjaka', function (Blueprint $table) {
            $table->id();
            $table->string('subjek');
            $table->string('isi_pengaduan');
            $table->string('file_pengaduan')->nullable();
            $table->string('id_kategori');
            $table->boolean('id_warga');
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
        Schema::dropIfExists('omjaka');
    }
}
