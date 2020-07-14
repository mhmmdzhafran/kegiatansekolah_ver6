<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyPenjelasanAsesmenIdToKeteranganSkorAsesmens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keterangan_skor_asesmens', function (Blueprint $table) {
            //
            $table->foreign('penjelasan_asesmen_id')->references('id')->on('penjelasan_asesmens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('keterangan_skor_asesmens', function (Blueprint $table) {
            //
            $table->dropForeign('keterangan_skor_asesmens_penjelasan_asesmen_id_foreign');
        });
    }
}
