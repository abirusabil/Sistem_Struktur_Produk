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
        Schema::create('kebutuhan_kayu_items', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('Item_Id')->foreign()->references('id')->on('items');
            $table->string('Kayu_Id')->foreign()->references('id')->on('master_kayus');
            $table->string('KP_Kebutuhan_Kayu_Item');
            $table->string('Keterangan_Kebutuhan_Kayu_Item');
            $table->string('Grade_Kebutuhan_Kayu_Item');
            $table->decimal('Tebal_Kebutuhan_Kayu_Item');
            $table->decimal('Lebar_Kebutuhan_Kayu_Item');
            $table->decimal('Panjang_Kebutuhan_Kayu_Item');
            $table->decimal('Quantity_Kebutuhan_Kayu_Item');
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
        Schema::dropIfExists('kebutuhan_kayu_items');
    }
};
