<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusDokumenToDokumenKegiatans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dokumen_kegiatans', function (Blueprint $table) {
            //
            $table->string('status_unggah_dokumen')->nullable()->after('nama_dokumen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dokumen_kegiatans', function (Blueprint $table) {
            //
            $table->dropColumn('status_unggah_dokumen');
        });
    }
}
