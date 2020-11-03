<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->string('nama_canvaser');
            $table->string('nama_pemilik');
            $table->string('alamat_lengkap');
            $table->string('rt_rw');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('kota');
            $table->integer('kode_pos');
            $table->string('jenis_usaha');
            $table->string('aplikasi_chat');
            $table->string('nomor_whatsapp');
            $table->string('status_bangunan');
            $table->string('tiga_produk');
            $table->string('foto_ktp');
            $table->string('foto_bangunan');
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
        Schema::dropIfExists('data');
    }
}
