<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengajuanKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_kegiatans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned()->nullable()->index();
            // $table->integer('status_kegiatan_id')->unsigned()->nullable()->index();
            $table->string('PJ_nama_kegiatan');
            $table->longtext('nilai_ppk');
            $table->longText('dokumen_kegiatan');
            $table->date('mulai_kegiatan');
            $table->date('akhir_kegiatan');
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
        Schema::dropIfExists('pengajuan_kegiatans');
    }
}
