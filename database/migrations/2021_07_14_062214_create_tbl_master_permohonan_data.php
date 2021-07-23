<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMasterPermohonanData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_master_permohonan_data', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nama_pemohon', 255);
            $table->string('nik', 20);
            $table->text('alamat');
            $table->string('pekerjaan', 255);
            $table->string('no_hp', 14);
            // $table->email('nama', 50);
            $table->text('nama_data');
            $table->text('ket');
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
        Schema::dropIfExists('tbl_master_permohonan_data');
    }
}
