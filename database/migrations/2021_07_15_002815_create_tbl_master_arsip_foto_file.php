<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMasterArsipFotoFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_master_arsip_foto_file', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('master_arsip_foto_id');
            $table->string('nama_file')->nullable();
            $table->string('keterangan')->nullable();
            $table->foreign('master_arsip_foto_id')->references('id')->on('tbl_master_arsip_foto')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_master_arsip_foto_file');
    }
}
