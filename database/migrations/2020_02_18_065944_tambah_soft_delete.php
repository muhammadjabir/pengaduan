<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahSoftDelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_data', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('master_data_detail', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('menu', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('child_menu', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_data', function (Blueprint $table) {
            //
        });
    }
}
