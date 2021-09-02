<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColomToTblMasterInventarisBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_master_inventaris_barang', function (Blueprint $table) {
            //
              $table->string('kondisi', 30)->nullable();
            $table->string('pemakai', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_master_inventaris_barang', function (Blueprint $table) {
            //
        });
    }
}
