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
        Schema::create('kebutuhan_pendukung_packing_items', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('Item_Id')->foreign()->references('id')->on('items');
            $table->string('Pendukung_Packing_Id')->foreign()->references('id')->on('master_pendukung_packings');
            $table->string('Keterangan_Kebutuhan_Pendukung_Packing_Item');
            $table->decimal('Lebar_Kebutuhan_Pendukung_Packing_Item');
            $table->decimal('Panjang_Kebutuhan_Pendukung_Packing_Item');
            $table->decimal('Quantity_Kebutuhan_Pendukung_Packing_Item');
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
        Schema::dropIfExists('kebutuhan_pendukung_packing_items');
    }
};
