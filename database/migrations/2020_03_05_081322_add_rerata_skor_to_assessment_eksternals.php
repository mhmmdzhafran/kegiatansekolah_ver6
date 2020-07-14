<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRerataSkorToAssessmentEksternals extends Migration
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
            $table->integer('rerata_indikator_1')->after('indikator_skor_penilaian_ppk')->unsigned();
            $table->integer('rerata_indikator_2')->after('rerata_indikator_1')->unsigned();
            $table->integer('rerata_indikator_3')->after('rerata_indikator_2')->unsigned();
            $table->integer('rerata_indikator_4')->after('rerata_indikator_3')->unsigned();
            $table->integer('rerata_indikator_5')->after('rerata_indikator_4')->unsigned();
            $table->integer('rerata_indikator_6')->after('rerata_indikator_5')->unsigned();
            $table->integer('rerata_indikator_7')->after('rerata_indikator_6')->unsigned();
            $table->integer('rerata_indikator_8')->after('rerata_indikator_7')->unsigned();
            $table->integer('rerata_indikator_9')->after('rerata_indikator_8')->unsigned();
            $table->integer('rerata_indikator_10')->after('rerata_indikator_9')->unsigned();
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
            $table->dropColumn('rerata_indikator_1');
            $table->dropColumn('rerata_indikator_2');
            $table->dropColumn('rerata_indikator_3');
            $table->dropColumn('rerata_indikator_4');
            $table->dropColumn('rerata_indikator_5');
            $table->dropColumn('rerata_indikator_6');
            $table->dropColumn('rerata_indikator_7');
            $table->dropColumn('rerata_indikator_8');
            $table->dropColumn('rerata_indikator_9');
            $table->dropColumn('rerata_indikator_10');
        });
    }
}
