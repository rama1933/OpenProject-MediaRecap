<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMasterPeliputan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_master_peliputan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('jam', 255);
            $table->text('tempat');
            $table->text('nama_kegiatan');
            $table->unsignedBigInteger('master_petugas_id');
            $table->unsignedBigInteger('master_petugas_editor_id');
            $table->foreign('master_petugas_id')->references('id')->on('tbl_master_petugas')->onDelete('cascade');
            $table->foreign('master_petugas_editor_id')->references('id')->on('tbl_master_petugas')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_master_peliputan');
    }
}
