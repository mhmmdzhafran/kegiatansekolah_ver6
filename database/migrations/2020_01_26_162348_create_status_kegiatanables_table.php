<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusKegiatanablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_kegiatanables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('status_kegiatan_id');
            $table->integer('status_kegiatanable_id');
            $table->string('status_kegiatanable_type');
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
        Schema::dropIfExists('status_kegiatanables');
    }
}
