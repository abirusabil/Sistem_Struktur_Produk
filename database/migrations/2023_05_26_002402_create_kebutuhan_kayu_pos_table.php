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
        Schema::create('kebutuhan_kayu_pos', function (Blueprint $table) {
            $table->id();
            $table->string('Job_Order')->foreign()->references('id')->on('purchase_orders');
            $table->string('Item_Id')->foreign()->references('id')->on('items');
            $table->string('Nama_Item');
            $table->decimal('Quantity_Purchase_Order');
            $table->string('No_Cutting')->foreign()->references('id')->on('kebutuhan_kayu_items');
            $table->string('Kayu_Id')->foreign()->references('id')->on('master_kayus');
            $table->string('Nama_Kayu');
            $table->string('KP_Kebutuhan_Kayu_Item');
            $table->string('Keterangan_Kebutuhan_Kayu_Item');
            $table->string('Grade_Kebutuhan_Kayu_Item');
            $table->decimal('Tebal_Kebutuhan_Kayu_Item');
            $table->decimal('Lebar_Kebutuhan_Kayu_Item');
            $table->decimal('Panjang_Kebutuhan_Kayu_Item');
            $table->decimal('Quantity_Kebutuhan_Kayu_Item');
            $table->decimal('Harga_Kayu',20,2);
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
        Schema::dropIfExists('kebutuhan_kayu_pos');
    }
};
