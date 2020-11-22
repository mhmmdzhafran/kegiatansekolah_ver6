<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDokumentasiKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumentasi_kegiatans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('folder_dokumentasi_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->index();
            $table->string('nama_kegiatan');
            // $table->longText('dokumentasi_kegiatan_ppk')->nullable();
            $table->longText('keterangan_dokumentasi');
            // $table->longText('keterangan_json');
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
        Schema::dropIfExists('dokumentasi_kegiatans');
    }
}
