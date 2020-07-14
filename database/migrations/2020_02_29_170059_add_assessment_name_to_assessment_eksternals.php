<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAssessmentNameToAssessmentEksternals extends Migration
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
            $table->string('nama_assessment')->after('id');
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
            $table->dropColumn('nama_assessment');
        });
    }
}
