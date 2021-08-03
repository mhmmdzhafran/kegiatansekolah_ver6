<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentInternalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_internals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable();
            $table->string('nama_sekolah');
            $table->string('alamat_sekolah');
            $table->string('nama_kepsek');
            $table->string('nomor_hp');
            $table->string('email_kepsek');
            $table->longText('indikator_skor_penilaian_ppk')->nullable();
            $table->decimal('rerata_indikator_1')->unsigned()->nullable();
            $table->decimal('rerata_indikator_2')->unsigned()->nullable();
            $table->decimal('rerata_indikator_3')->unsigned()->nullable();
            $table->decimal('rerata_indikator_4')->unsigned()->nullable();
            $table->decimal('rerata_indikator_5')->unsigned()->nullable();
            $table->decimal('rerata_indikator_6')->unsigned()->nullable();
            $table->decimal('rerata_indikator_7')->unsigned()->nullable();
            $table->decimal('rerata_indikator_8')->unsigned()->nullable();
            $table->decimal('rerata_indikator_9')->unsigned()->nullable();
            $table->decimal('rerata_indikator_10')->unsigned()->nullable();
            $table->decimal('skor_penilaian_kegiatan_akhir')->unsigned()->nullable();
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
        Schema::dropIfExists('assessment_internals');
    }
}
