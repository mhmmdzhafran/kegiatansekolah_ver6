<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDokumentasiKegiatanIdToFolderDokumentasis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('folder_dokumentasis', function (Blueprint $table) {
            //
            $table->integer('dokumentasi_kegiatan_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('folder_dokumentasis', function (Blueprint $table) {
            //
            $table->dropColumn('dokumentasi_kegiatan_id');
        });
    }
}
