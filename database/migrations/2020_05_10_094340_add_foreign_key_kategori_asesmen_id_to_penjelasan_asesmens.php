<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyKategoriAsesmenIdToPenjelasanAsesmens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penjelasan_asesmens', function (Blueprint $table) {
            //
            $table->foreign('kategori_asesmen_id')->references('id')->on('kategori_asesmens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penjelasan_asesmens', function (Blueprint $table) {
            //
            $table->dropForeign('penjelasan_asesmens_kategori_asesmen_id_foreign');
        });
    }
}
