<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDetailSekolahToAssessmentEksternals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assessment_eksternals', function (Blueprint $table) {
            //
            $table->string('nama_sekolah')->after('user_id');
            $table->string('alamat_sekolah')->after('nama_sekolah');
            $table->string('nama_kepsek')->after('alamat_sekolah');
            $table->integer('nomor_hp')->after('nama_kepsek');
            $table->string('email_kepsek')->after('nomor_hp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assessment_eksternals', function (Blueprint $table) {
            //
            $table->dropColumn('nama_sekolah');
            $table->dropColumn('alamat_sekolah');
            $table->dropColumn('nama_kepsek');
            $table->dropColumn('nomor_hp');
            $table->dropColumn('email_kepsek');
        });
    }
}
