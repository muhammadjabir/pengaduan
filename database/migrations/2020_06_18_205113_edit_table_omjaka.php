<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditTableOmjaka extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('omjaka', function (Blueprint $table) {
            $table->integer('id_warga')->change();
            $table->string('nomor_registrasi',30)->unique();
            $table->string('kapan',100)->unique();
            $table->string('dimana',100)->unique();
            $table->string('file_pengaduan')->nullable()->change();
            $table->string('id_kategori')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('omjaka', function (Blueprint $table) {
            //
        });
    }
}
