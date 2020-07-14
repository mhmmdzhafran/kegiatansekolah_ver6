<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMulaiDanAkhirKegiatanToDokumentasiKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dokumentasi_kegiatans', function (Blueprint $table) {
            //
            $table->date('mulai_kegiatan')->after('keterangan_dokumentasi')->nullable();
            $table->date('akhir_kegiatan')->after('mulai_kegiatan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dokumentasi_kegiatans', function (Blueprint $table) {
            //
            $table->dropColumn('mulai_kegiatan');
            $table->dropColumn('akhir_kegiatan');
        });
    }
}
