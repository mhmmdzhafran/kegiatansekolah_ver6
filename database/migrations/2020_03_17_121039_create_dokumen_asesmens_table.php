<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDokumenAsesmensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_asesmens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('assessment_internal_id')->unsigned()->index();
            $table->string('nama_dokumen_asesmen')->nullable();
            $table->integer('body_indikator_dokumen')->unsigned()->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dokumen_asesmens');
    }
}
