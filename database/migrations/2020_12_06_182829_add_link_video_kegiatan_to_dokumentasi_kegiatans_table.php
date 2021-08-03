<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLinkVideoKegiatanToDokumentasiKegiatansTable extends Migration
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
            $table->longText('add_link_video')->after('tipe_kegiatan')->nullable();
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
            $table->dropColumn('add_link_video');
        });
    }
}
