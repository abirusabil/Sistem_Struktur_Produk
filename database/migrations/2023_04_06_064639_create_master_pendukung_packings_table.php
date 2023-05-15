<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_pendukung_packings', function (Blueprint $table) {
            // $table->id();
            $table->string('id')->primary();
            $table->string('Nama_Pendukung_Packing');
            $table->decimal('Tebal_Pendukung_Packing');
            $table->decimal('Lebar_Pendukung_Packing');
            $table->decimal('Panjang_Pendukung_Packing');
            $table->decimal('Harga_Pendukung_Packing',12,2);
            $table->string('Satuan_Pendukung_Packing');
            $table->foreignId('Suplier_Id');
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
        Schema::dropIfExists('master_pendukung_packings');
    }
};
