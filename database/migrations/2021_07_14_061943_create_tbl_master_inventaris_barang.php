<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMasterInventarisBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_master_inventaris_barang', function (Blueprint $table) {
            $table->id();
            $table->string('id_barang', 12);
            $table->string('kategori', 4);
            $table->string('nama', 255);
            $table->string('stok', 255);
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
        Schema::dropIfExists('tbl_master_inventaris_barang');
    }
}
