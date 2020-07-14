<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyFolderDokumentasiIdToDokumentasiKegiatansTable extends Migration
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
            // $table->integer('folder_dokumentasi_id');

            $table->foreign('folder_dokumentasi_id')->references('id')->on('folder_dokumentasis')->onDelete('cascade');
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
            $table->dropForeign('dokumentasi_kegiatans_folder_dokumentasi_id_foreign');
            // $table->dropColumn('folder_dokumentasi_id');
        });
    }
}
