<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLinkArtikelKegiatanToDokumentasiKegiatansTable extends Migration
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
            $table->longText('add_link_article')->after('add_link_video')->nullable();
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
            $table->dropColumn('add_link_article');
        });
    }
}
