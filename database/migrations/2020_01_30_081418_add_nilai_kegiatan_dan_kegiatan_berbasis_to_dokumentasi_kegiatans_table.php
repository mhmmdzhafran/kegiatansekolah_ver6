<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNilaiKegiatanDanKegiatanBerbasisToDokumentasiKegiatansTable extends Migration
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
            $table->longText('nilai_ppk')->after('nama_kegiatan')->nullable();
            $table->string('kegiatan_berbasis')->after('nilai_ppk')->nullable();
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
            $table->dropColumn('nilai_ppk');
            $table->dropColumn('kegiatan_berbasis');
        });
    }
}
