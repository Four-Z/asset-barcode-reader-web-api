<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asets', function (Blueprint $table) {
            $table->string('id_barcode', 20)->primary();
            $table->string('nama_aset', 30);
            $table->string('merk_aset', 30);
            $table->string('tahun_beli', 4);
            $table->integer('harga_beli');
            $table->unsignedBigInteger('kondisi_aset');
            $table->string('lokasi_aset', 255);
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('kondisi_aset')->references('id')->on('kondisi_aset');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asets', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
