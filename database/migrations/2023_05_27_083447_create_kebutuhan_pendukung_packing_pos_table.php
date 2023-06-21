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
        Schema::create('kebutuhan_pendukung_packing_pos', function (Blueprint $table) {
            $table->id();
            $table->string('Job_Order')->foreign()->references('id')->on('purchase_orders');
            $table->string('Nama_Item');
            $table->decimal('Quantity_Purchase_Order');
            $table->string('No_Cutting')->foreign()->references('id')->on('kebutuhan_pendukung_packing_items');
            $table->string('Pendukung_Packing_Id')->foreign()->references('id')->on('master_pendukung_packings');
            $table->string('Nama_Pendukung_Packing');
            $table->string('Keterangan_Kebutuhan_Pendukung_Packing_Item');
            $table->decimal('Lebar_Kebutuhan_Pendukung_Packing_Item');
            $table->decimal('Panjang_Kebutuhan_Pendukung_Packing_Item');
            $table->decimal('Quantity_Kebutuhan_Pendukung_Packing_Item');
            $table->decimal('Tebal_Pendukung_Packing');
            $table->decimal('Luas_Pendukung_Packing');
            $table->string('Satuan_Pendukung_Packing');
            $table->decimal('Harga_Pendukung_Packing',20,2);
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
        Schema::dropIfExists('kebutuhan_pendukung_packing_pos');
    }
};
